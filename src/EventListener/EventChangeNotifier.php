<?php

namespace App\EventListener;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Bundle\SecurityBundle\Security;


class EventChangeNotifier
{ 
  public $inserts;
  public $updates;
  public $collectionDeletions;
  public $collectionUpdates;
  public function __construct(private Security $security)
  {
    
  }

  public function onFlush(OnFlushEventArgs $eventArgs)
  {   
    $em = $eventArgs->getObjectManager();
    $uow = $em->getUnitOfWork();
    
      foreach ($uow->getScheduledEntityInsertions() as $entity) {
        $this->inserts[] = $entity;
      }

      foreach ($uow->getScheduledEntityUpdates() as $entity) {
        $this->updates[] = $entity;
      }

      foreach ($uow->getScheduledEntityDeletions() as $entity) {
        $this->logChange($em, $entity, 'delete', $this->entityToArray($entity, $em));
      }

      foreach ($uow->getScheduledCollectionDeletions() as $col) {
        $clone = $col->getSnapshot();
        $this->collectionDeletions[] = [$col, $clone];
      }

      foreach ($uow->getScheduledCollectionUpdates() as $col) {
        $clone = $col->getSnapshot();
        $this->collectionUpdates[] = [$col, $clone];
      }
  }

  public function postFlush(PostFlushEventArgs $eventArgs)
  {
    $em = $eventArgs->getObjectManager();

    if ($this->inserts) {
      foreach ($this->inserts as $entity) {
        $this->logChange($em, $entity, 'insert', $this->entityToArray($entity, $em));
      }
    }

    if ($this->updates) {
      foreach ($this->updates as $entity) {
        $uow = $em->getUnitOfWork();
        $changedSet = $uow->getEntityChangeSet($entity);
        $data = $this->rebuildUpdate($changedSet, $em);
        $this->logChange($em, $entity, 'update', $data);
      }
    }

    if ($this->collectionDeletions) {
      foreach ($this->collectionDeletions as $col) {
        // dump('colletion delation');
        // dd($col);
        $this->logCollectionChange($em, $col, 'delete');
      }
    }

    if ($this->collectionUpdates) {
      foreach ($this->collectionUpdates as $col) {
        // dump('colletion update');
        // dd($col);
        $this->logCollectionChange($em, $col, 'update');
      }
    }

  }

  public function entityToArray($entity, $em):array
  {
    $array = [];
    $reflectionClass = new \ReflectionClass($entity);
    $properties = $reflectionClass->getProperties();
    foreach ($properties as $property) {
      $property->setAccessible(true);
      $value = $property->getValue($entity);
      $array[$property->getName()] = $this->resolveValueEntity($value, $em);
    }
    return $array;
  }

  private function resolveValueEntity($value, $em)
  {
    if (is_object($value) && $em->getMetadataFactory()->hasMetadataFor(get_class($value))) {
      return method_exists($value, 'getId') ? $value->getId() : null;
    }
    return $value;
  }

  public function logChange($em, $entity, $action, $data)
  {
    // Limitar a escrita de logs para as entidades Banner e News
      // if (
      //   get_class($entity) === 'App\Entity\Banner' AND 
      //   get_class($entity) === 'App\Entity\News'
      // ) {
      //   return;
      // }

    $query = 'INSERT INTO log (entity, action, date_time, change_fields, user_id, entity_id) VALUES (?, ?, ?, ?, ?, ?)';
    $smtp = $em->getConnection()->prepare($query);
    $smtp->bindValue(1, get_class($entity));
    $smtp->bindValue(2, $action);
    $smtp->bindValue(3, date('Y-m-d H:i:s'));
    $smtp->bindValue(4, json_encode( $data));
    $smtp->bindValue(5, $this->security->getUser()->getId());
    $smtp->bindValue(6, $entity->getId());
    $smtp->executeStatement();
  }

  public function rebuildUpdate($changedSet, $em)
  {
    $reformattedChangeSet = [];
    foreach ($changedSet as $field => $value) {
      [$oldvalue, $newvalue] = $value;
      $oldvalue = $this->resolveValueEntity($oldvalue, $em);
      $newvalue = $this->resolveValueEntity($newvalue, $em);
      $reformattedChangeSet[$field] = [$oldvalue, $newvalue];
    }
    
    return $reformattedChangeSet;
  }

  private function logCollectionChange($em, $collection, $action)
  {
    
    $owner = $collection[0]->getOwner();
    $entityClass = get_class($owner);
    $mapping = $collection[0]->getMapping();
    $role = $mapping['fieldName'];

    // obter os valores originais
    $originalData = $collection[1];
    $currentData = $collection[0]->toArray();

    $originalIds = [];
    foreach ($originalData as $index => $currentDatum) {
        $originalIds[] = $this->resolveValueEntity($currentDatum, $em);
    }

    $currentIds = [];
    foreach ($currentData as $index => $currentDatum) {
        $currentIds[] = $this->resolveValueEntity($currentDatum, $em);
    }

    $data = [
        'role' => $role,
        'original_ids' => $originalIds,
        'current_ids' => $currentIds,
    ];

    $this->logChange($em, $owner, $action, $data);
  }

}
