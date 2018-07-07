<?php

namespace App\Helpers;

class CrudHelper {

	public static function save($table, $data) {
        try 
        {
            return $table->create($data);
        } catch (\Exception $e) {
            \Log::error($e);
            return $e;
        }
    }

    public static function delete($table, $field, $key)
    {
        try
        {
            return $table->where($field, $key)->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return $e;
        }
        
    }

    public static function update($table, $field, $key, $data)
    {
        try
        {
            return $table->where($field, $key)->update($data);
        } catch (\Exception $e) {
            \Log::error($e);
            return $e;
        }
    }

    public static function getSingleData($table, $field, $key)
    {
        try
        {
            return $table->where($field, $key)->first();
        } catch (\Exception $e) {
            \Log::error($e);
            return $e;
        }
    }
    
    public static function getAll($table)
    {
        try
        {
            return $table->all();
        } catch (\Exception $e) {
            \Log::error($e);
            return $e;
        }
    }

    public static function base($table)
    {
        try
        {
            return $table;
        } catch (\Exception $e) {
            \Log::error($e);
            return $e;
        }
    }

    public static function getWhere($table, $field, $key)
    {
        try
        {
            return $table->where($field, $key)->get();
        } catch (\Exception $e) {
            \Log::error($e);
            return $e;
        }
    }

}