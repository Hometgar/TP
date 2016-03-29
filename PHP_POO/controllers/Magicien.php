<?php

/**
 * Created by PhpStorm.
 * User: Mika
 * Date: 29/03/2016
 * Time: 20:42
 */
class Magicien extends Personnage
{
    private $atout;

    public function sort(Personnage $perso){
        if ($perso->id() == $this->id)
        {
            return self::CEST_MOI;
        }

        $perso->fallAsleep()
    }
}