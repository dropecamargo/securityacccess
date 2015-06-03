<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomerAddress extends Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cliente_direccion';

    public $timestamps = false;

	public static $states = array('0' => 'Inactivo', '1' => 'Activo');
}