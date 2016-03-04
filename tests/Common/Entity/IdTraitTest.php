<?php
namespace pdt256\article\Common\Entity;

use Mockery;
use pdt256\article\tests\Helper\Entity\EntityUsingId;
use pdt256\article\tests\Helper\TestCase\EntityTestCase;

class IdTraitTest extends EntityTestCase
{
    public function testSettersGetters()
    {
        $entity = new EntityUsingId;
        $entity->setId(1);

        $this->assertSame(1, $entity->getId());
    }

    public function testClone()
    {
        $entity1 = new EntityUsingId;
        $entity1->setId(1);

        $entity2 = clone $entity1;
        $this->assertSame(null, $entity2->getId());
    }
}
