<?php
namespace App\Models;

use CodeIgniter\Model;

class Vouchers extends Model
{
    protected $table = 'vouchers';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['worth','pin','used','usedBy','genBy'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
