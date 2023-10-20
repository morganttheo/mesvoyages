<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Validations;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of VisiteValidationsTest
 *
 * @author theom
 */
class VisiteValidationsTest extends KernelTestCase{
    
    public function getVisite(): Visite{
        return (new Visite())
                ->setVille("New York")
                ->setPays("USA");
    }
    public function testValidNoteVisite(){
        $visite = $this->getVisite()->setNote(10);
        $this->assertErrors($visite,0);
        $visite = $this->getVisite()->setNote(20);
        $this->assertErrors($visite,0);
    }
    public function testNonValidNoteVisite(){
        $visite = $this->getVisite()->setNote(21);
        $this->assertErrors($visite,1);
        $visite = $this->getVisite()->setNote(-3);
        $this->assertErrors($visite,1);
    }
    public function assertErrors(Visite $visite, int $nbErreursAttendues, string $message=""){
        self::bootKernel();
        $validator = self::getContainer() ->get(ValidatorInterface::class);
        $error = $validator ->validate($visite);
        $this->assertCount($nbErreursAttendues,$error, $message);
    }
    public function testNonValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(20)
                ->setTempMax(18);
        $this->assertErrors($visite, 1,"min=20, max=18 devrait échouer");
        $visite = $this->getVisite()
                ->setTempmin(5)
                ->setTempMax(19);
        $this->assertErrors($visite, 0,"min=5, max=19 devrait réussir");
        $visite = $this->getVisite()
                ->setTempmin(15)
                ->setTempMax(16);
        $this->assertErrors($visite, 0,"min=15, max=16 devrait échouer");
        $visite = $this->getVisite()
                ->setTempmin(18)
                ->setTempMax(18);
        $this->assertErrors($visite, 1,"min=18, max=18 devrait échouer");
    }
    
}

    