<?php
abstract class Personnage
{
    protected $degats,
        $id,
        $nom,
        $nbAttaque,
        $lastAttaque,
        $raiseAt;

    const CEST_MOI = 1; // Constante renvoyée par la méthode `frapper` si on se frappe soi-même.
    const PERSONNAGE_TUE = 2; // Constante renvoyée par la méthode `frapper` si on a tué le personnage en le frappant.
    const PERSONNAGE_FRAPPE = 3; // Constante renvoyée par la méthode `frapper` si on a bien frappé le personnage.
    const ATTAQUE_MAX = 4;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function frapper(Personnage $perso)
    {
        if ($perso->id() == $this->id)
        {
            return self::CEST_MOI;
        }

        // On indique au personnage qu'il doit recevoir des dégâts.
        // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE
        if($this->nbAttaque <= 2) {
            $this->nbAttaque++;
            return $perso->recevoirDegats();
        }else{
            return self::ATTAQUE_MAX;
        }
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function recevoirDegats()
    {
        $this->degats += 5;

        // Si on a 100 de dégâts ou plus, on dit que le personnage a été tué.
        if ($this->degats >= 100)
        {
            return self::PERSONNAGE_TUE;
        }

        // Sinon, on se contente de dire que le personnage a bien été frappé.
        return self::PERSONNAGE_FRAPPE;
    }

    public function nomValide(){
        return !empty($this->nom);
    }

    // GETTERS //


    public function degats()
    {
        return $this->degats;
    }

    public function id()
    {
        return $this->id;
    }

    public function nom()
    {
        return $this->nom;
    }

    public function setDegats($degats)
    {
        $degats = (int) $degats;

        if ($degats >= 0 && $degats <= 100)
        {
            $this->degats = $degats;
        }
    }

    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0)
        {
            $this->id = $id;
        }
    }

    public function setNom($nom)
    {
        if (is_string($nom))
        {
            $this->nom = $nom;
        }
    }

    /**
     * @return mixed
     */
    public function getLastAttaque()
    {
        return $this->lastAttaque;
    }

    /**
     * @param mixed $lastAttaque
     */
    public function setLastAttaque($lastAttaque)
    {
        $this->lastAttaque = $lastAttaque;
    }

    /**
     * @return mixed
     */
    public function getNbAttaque()
    {
        return $this->nbAttaque;
    }

    /**
     * @param mixed $nbAttaque
     */
    public function setNbAttaque($nbAttaque)
    {
        $this->nbAttaque = $nbAttaque;
    }

    public function raiseAt(){
        return $this->raiseAt;
    }

    public function fallAsleep($value){
        $this->raiseAt = $value;
    }

    public function atout(){
        if($this->degats <= 25){
            return 4;
        }elseif ($this->degats <= 50){
            return 3;
        }elseif ($this->degats <= 75){
            return 2;
        }elseif ($this->degats <=90)
    }
}