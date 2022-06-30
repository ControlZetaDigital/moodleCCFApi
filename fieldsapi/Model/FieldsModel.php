<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class FieldsModel extends Database
{

    private string $category_tbl;
    
    private string $field_tbl;

    private string $data_tbl;

    public function __construct()
    {        
        $this->category_tbl = PREFIX . 'customfield_category';
        $this->field_tbl = PREFIX . 'customfield_field';
        $this->data_tbl = PREFIX . 'customfield_data';
        parent::__construct();
    }

    public function getFields($id)
    {
        $query = "
            SELECT 
                F.name as name, 
                F.shortname as slug, 
                D.value as value 
            FROM {$this->data_tbl} D 
            LEFT JOIN {$this->field_tbl} F 
            ON D.fieldid = F.id 
            WHERE D.instanceid = ?
        ";

        $result = $this->select($query, ["i", $id]);

        return [
            'courseid' => $id,
            'fields' => $result
        ];
    }
}