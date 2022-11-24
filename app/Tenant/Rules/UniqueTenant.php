<?php

namespace App\Tenant\Rules;

use App\Tenant\ManagerTenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueTenant implements Rule
{
    protected $table, $value, $collumn;

    /**
     * Create a new rule instance.
     * Recebe um parametro do tipo string que é o nome da tabela ou seja a qual tabela o valor seja unico
     *
     * @return void
     */
    public function __construct(string $table, $value = null, $collumn = 'id')
    {
        $this->table = $table;
        $this->value = $value;
        $this->collumn = $collumn;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /**Primeiro pega o identificador do Tenant do usuario autenticado */
        $tenantId = app(ManagerTenant::class)->getTenantId();

        /**Procura na tabela se já existe um registo unico na tabela por Tenant pelo atributo e o valor que esta sendo inserido */
        $register = DB::table($this->table)
                    ->where($attribute, $value)
                    ->where('tenant_id', $tenantId)
                    ->first();

        /**Para EDITAR verifica se o id do registo é igual ao elemento que está tentando editar. */
        if ($register && $register->{$this->collumn} == $this->value) {
            return true;
        }

        /**Se for null, então passa na validação e faz o registo */
        return is_null($register);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        //return 'The validation error message.';
        return 'O valor para :attribute já existe!!!';
    }
}
