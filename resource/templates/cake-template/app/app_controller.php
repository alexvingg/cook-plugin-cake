<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {

    var $paginate = array('limit' => 10);
    var $redirect = "";

    function beforeFilter() {
        $tema = Cache::read('tema');
        if ($tema == null) {
            $tema = "redmond";
            Cache::set(array('duration' => '+1 hours'));
            Cache::write('tema', $tema);
        }
        $this->set('tema', $tema);
    }

    function changeTema($tema) {
        Cache::set(array('duration' => '+1 hours'));
        Cache::write('tema', $tema);
        $this->redirect($this->getRedirect());
    }

    /* Metodos protegidos do Controllador */

    protected function getRedirect() {
        return $this->redirect == "" ? array('action' => 'index') : $this->redirect;
    }

    protected function setRedirect($red) {
        $this->redirect = $red;
    }

    protected function getInst() {
        array_push($this->helpers, 'Jquery');
        $model_class = $this->modelClass;
        $this->Model = $this->$model_class;
    }

    protected function loadbelongsTo(&$Model) {
        if (count($Model->belongsTo) > 0) {
            foreach ($Model->belongsTo as $key => $obj) {
                if ($obj['className'] == $Model->name) { //Autorelacionamento
                    $plural = Inflector::pluralize(strtolower($Model->name));
                    $Parent = $key;
                    $$plural = $Model->$Parent->find('list');
                    $this->set($plural, $$plural);
                } else {
                    $plural = Inflector::pluralize(strtolower($obj['className']));
                    $$plural = $Model->$obj['className']->find('list');
                    $this->set($plural, $$plural);
                }
            }
        }
    }

    protected function loadhasAndBelongsToMany(&$Model) {
        if (count($Model->hasAndBelongsToMany) > 0) {
            foreach ($Model->hasAndBelongsToMany as $obj) {
                $plural = Inflector::pluralize(strtolower($obj['className']));
                $$plural = $Model->$obj['className']->find('list');
                $this->set(compact($plural));
            }
        }
    }

    /* Metodos publicos do Controllador */

    function help() {
        $this->getInst();
        $this->render('/pages/help');
    }

    function index() {
        $this->getInst();
        $this->Model->recursive = 0;
        $this->set($this->viewPath, $this->paginate());
    }

    function view($id = null) {
        $this->getInst();
        if (empty ($id)) {
            $this->Session->setFlash($this->modelClass . ' Invalido.', "flash_error");
            $this->redirect($this->getRedirect());
        }
        $this->set($this->modelKey, $this->Model->read(null, $id));
    }

    function add() {
        $this->getInst();
        if (!empty($this->data)) {
            $this->Model->create();
            if ($this->Model->save($this->data)) {
                $this->Session->setFlash($this->modelClass . ' foi salvo com sucesso.', "flash_success");
                $this->redirect($this->getRedirect());
            } else {
                $this->Session->setFlash('ERRO ao salvar ' . $this->modelClass . '. Verifique os problemas e tente novamente.', "flash_error");
            }
        }
        $this->loadbelongsTo($this->Model);
        $this->loadhasAndBelongsToMany($this->Model);
    }

    function edit($id = null) {
        $this->getInst();
        if (empty ($id) && empty($this->data)) {
            $this->Session->setFlash($this->modelClass . ' Inválido', "flash_error");
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Model->save($this->data)) {
                $this->Session->setFlash($this->modelClass . ' foi salvo com sucesso', "flash_success");
                $this->redirect($this->getRedirect());
            } else {
                $this->Session->setFlash('ERRO ao salvar ' . $this->modelClass . '. Verifique os problemas e tente novamente.', "flash_error");
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Model->read(null, $id);
            $this->loadbelongsTo($this->Model);
            $this->loadhasAndBelongsToMany($this->Model);
        }
    }

    function delete($id = null) {
        $this->getInst();
        if (empty ($id)) {
            $this->Session->setFlash('Identificador inválido para ' . $this->modelClass, "flash_error");
            $this->redirect($this->getRedirect());
        }

        if ($this->Model->deleteAll($this->modelClass . "." . $this->Model->primaryKey . " in (" . $id . ")")) {
            $this->Session->setFlash('Registros excluidos com sucesso', "flash_success");
            $this->redirect($this->getRedirect());
        }
    }

}
