<?php
interface ICrud {
    public function create ($data);
    public function read ($id = null);
    public function update ($id, $data);
    public function delete ($id);
}