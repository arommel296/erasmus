<?php

class ConvocatoriaRepo implements dbInterface{
    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    function findById($id){
        $sql = "SELECT * FROM convocatoria where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro) {
                $convocatoria = new Convocatoria($registro['id'], $registro['movilidades'], $registro['duracion'], $registro['tipo'], $registro['inicioSolicitud'],
                $registro['finSolicitud'], $registro['inicioPrueba'], $registro['finPrueba'], $registro['listaProv'], $registro['listaDef'], $registro['codigoProyecto'],
                $registro['destinos']);
                return $convocatoria;
            }
        } 
        return null;
    }
    
    // function findAll(){
    //     $sql = "SELECT * FROM convocatoria";
    //     $statement = $this->conex->prepare($sql);
    //     $statement->execute();
    //     if ($this->conex!=null) {
    //         $registro = $statement->fetchAll(PDO::FETCH_ASSOC);
    //         return $registro;
    //     }
    //     return null;
    // }

    function findAll(){
        $sql = "SELECT * FROM convocatoria";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        $convocatorias = [];
    
        if ($this->conex != null) {
            while ($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
                $convocatoria = new Convocatoria(
                    $registro['id'],
                    $registro['movilidades'],
                    $registro['duracion'],
                    $registro['tipo'],
                    $registro['inicioSolicitud'],
                    $registro['finSolicitud'],
                    $registro['inicioPrueba'],
                    $registro['finPrueba'],
                    $registro['listaProv'],
                    $registro['listaDef'],
                    $registro['codigoProyecto'],
                    $registro['destinos']
                );
                $convocatorias[] = $convocatoria;
            }
        }
    
        return $convocatorias;
    }


    function findAllByDate($fecha){
        $sql = "SELECT * FROM convocatoria WHERE inicioSolicitud >= :fecha";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':fecha',$fecha);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $registro;
        }
        return null;
    }

    function findAllDisponibles(){
        $hoy = date("y/m/d");
        $sql = "SELECT * FROM convocatoria WHERE inicioSolicitud >= :fecha";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':fecha', $hoy);
        $statement->execute();
        $convocatorias = [];
    
        if ($this->conex != null) {
            while ($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
                $convocatoria = new Convocatoria(
                    $registro['id'],
                    $registro['movilidades'],
                    $registro['duracion'],
                    $registro['tipo'],
                    $registro['inicioSolicitud'],
                    $registro['finSolicitud'],
                    $registro['inicioPrueba'],
                    $registro['finPrueba'],
                    $registro['listaProv'],
                    $registro['listaDef'],
                    $registro['codigoProyecto'],
                    $registro['destinos']
                );
                $convocatorias[] = $convocatoria;
            }
        }
    
        return $convocatorias;
    }



    function findByName($name) {
        //Si no lo pongo me da error.
    }
    
    function deleteById($id){
        $sql = "delete FROM convocatoria where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }

    function delete($object){
        return $this->deleteById($object->getId());
    }
    
    function save($object){
        $id=$object->getId();
        if($id!=""){
            return $this->update($object);
        }else{
            return $this->insert($object);
        }
    }

    function update($object){
        $sql = "UPDATE convocatoria set movilidades = :movilidades, duracion = :duracion, tipo = :tipo, inicioSolicitud = :inicioSolicitud, finSolicitud = :finSolicitud,
        inicioPrueba = :inicioPrueba, finPrueba = :finPrueba, listaProv = :listaProv, listaDef = :listaDef, codigoProyecto = :codigoProyecto, destinos = :destinos where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->execute([':movilidades' => $object->getMovilidades(), ':duracion' => $object->getDuracion(), ':tipo' => $object->getTipo(),
        ':inicioSolicitud' => $object->getInicioSolicitud(), ':finSolicitud' => $object->getFinSolicitud(), ':inicioPrueba' => $object->getInicioPrueba(),
        ':finPrueba' => $object->getFinPrueba(), ':listaProv' => $object->getListaProv(), ':listaDef' => $object->getListaDef(), ':codigoProyecto' => $object->getCodigoProyecto(),
        ':destinos' => $object->getDestinos(), ':id' => $object->getId()]);
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function insert($object){
        $sql = "INSERT into convocatoria(movilidades, duracion, tipo, inicioSolicitud, finSolicitud, inicioPrueba, finPrueba, listaProv, listaDef, codigoProyecto, destinos)
        values(:movilidades, :duracion, :tipo, :inicioSolicitud, :finSolicitud, :inicioPrueba, :finPrueba, :listaProv, :listaDef, :codigoProyecto, :destinos)";
        $statement = $this->conex->prepare($sql);
        $statement->execute([':movilidades' => $object->getMovilidades(), ':duracion' => $object->getDuracion(), ':tipo' => $object->getTipo(),
        ':inicioSolicitud' => $object->getInicioSolicitud(), ':finSolicitud' => $object->getFinSolicitud(), ':inicioPrueba' => $object->getInicioPrueba(),
        ':finPrueba' => $object->getFinPrueba(), ':listaProv' => $object->getListaProv(), ':listaDef' => $object->getListaDef(), ':codigoProyecto' => $object->getCodigoProyecto(),
        ':destinos' => $object->getDestinos()]);
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }


    function transaction($convocatoria, $convocBaremo, $destinatarios, $nivelIdioma){
        try {
            $this->conex->beginTransaction();
    
            // Insertar en la tabla convocatoria
            $sql = "INSERT INTO `convocatoria` (movilidades, duracion, tipo, inicioSolicitud, finSolicitud, inicioPrueba, finPrueba, listaProv, listaDef, codigoProyecto, destinos)
                    VALUES (:movilidades, :duracion, :tipo, :inicioSolicitud, :finSolicitud, :inicioPrueba, :finPrueba, :listaProv, :listaDef, :codigoProyecto, :destinos)";
            $statement = $this->conex->prepare($sql);
            $statement->execute([
                ':movilidades' => $convocatoria->getMovilidades(),
                ':duracion' => $convocatoria->getDuracion(),
                ':tipo' => $convocatoria->getTipo(),
                ':inicioSolicitud' => $convocatoria->getInicioSolicitud(),
                ':finSolicitud' => $convocatoria->getFinSolicitud(),
                ':inicioPrueba' => $convocatoria->getInicioPrueba(),
                ':finPrueba' => $convocatoria->getFinPrueba(),
                ':listaProv' => $convocatoria->getListaProv(),
                ':listaDef' => $convocatoria->getListaDef(),
                ':codigoProyecto' => $convocatoria->getCodigoProyecto(),
                ':destinos' => $convocatoria->getDestinos()
            ]);
    
            $lastId = $this->conex->lastInsertId();
    
            // Insertar en la tabla convocatoria-baremo
            foreach($convocBaremo as $itemBaremable) {
                $sql = "INSERT INTO `convocatoria-baremo` (idConvocatoria, idItem, puntuacionMax, valorMin, aportaAlumno) 
                        VALUES (:idConvocatoria, :idItem, :puntuacionMax, :valorMin, :aportaAlumno)";
                $statement = $this->conex->prepare($sql);
                $statement->execute([
                    ':idConvocatoria' => $lastId,
                    ':idItem' => $itemBaremable->getIdItem(),
                    ':puntuacionMax' => $itemBaremable->getPuntuacionMax(),
                    ':valorMin' => $itemBaremable->getValorMin(),
                    ':aportaAlumno' => $itemBaremable->getAportaAlumno()
                ]);
            }
    
            // Insertar en la tabla destinatario-convocatoria
            foreach($destinatarios as $grupo) {
                $sql = "INSERT INTO `destinatario-convocatoria` (idConvocatoria, idDestinatario) 
                        VALUES (:idConvocatoria, :idDestinatario)";
                $statement = $this->conex->prepare($sql);
                $statement->execute([
                    ':idConvocatoria' => $lastId,
                    ':idDestinatario' => $grupo->getIdDestinatario()
                ]);
            }
    
            // Insertar en la tabla convocatoria-baremo-idioma
            foreach($nivelIdioma as $convoBareIdioma) {
                $sql = "INSERT INTO `convocatoria-baremo-idioma` (idConvocatoria, idNivel, PuntuacionNivel) 
                        VALUES (:idConvocatoria, :idNivel, :puntuacionNivel)";
                $statement = $this->conex->prepare($sql);
                $statement->execute([
                    ':idConvocatoria' => $lastId,
                    ':idNivel' => $convoBareIdioma->getIdNivel(),
                    ':puntuacionNivel' => $convoBareIdioma->getPuntuacionNivel()
                ]);
            }
    
            $this->conex->commit();
    
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->conex->rollBack();
        }
    }
    
    

}