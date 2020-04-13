<?php
namespace Mmidu\Auditable;

use Models\Audit;

trait Auditable
{
    protected $model_identifier = 'slug';
    protected $user_identifier = 'email';

    public static function bootAuditable()
    {
        static::updating(function ($model) {
            $changed = $model->isDirty() ? $model->getDirty() : false;
            if($changed){
                $original = get_class($model)::find($model->id);
                $data['table'] = $model->getTable();

                $data['model'] = $model->{config('auditable.identifiers.model')};
                $data['user'] = auth()->user()->{config('auditable.identifiers.user')};
                $data['date'] = date("Y-m-d H:i:s");
                foreach($changed as $key => $value){
                    $data['action'] = 'update';
                    $data['field'] = $key;
                    $data['old_value'] = $original->getAttributes()[$key];
                    $data['new_value'] = $value;
                    Audit::create($data);
                }
            }
        });

        static::created(function ($model) {
            $data['table'] = $model->getTable();

            $data['model'] = $model->{config('auditable.identifiers.model')};
            $data['user'] = auth()->user()->{config('auditable.identifiers.user')};
            $data['date'] = date("Y-m-d H:i:s");

            foreach($model->getAttributes() as $key => $value){
                $data['field'] = $key;
                $data['action'] = 'create';
                $data['new_value'] = $value;
                Audit::create($data);
            }
        });

        static::deleted(function ($model) {
            $data['table'] = $model->getTable();

            $data['model'] = $model->{config('auditable.identifiers.model')};
            $data['user'] = auth()->user()->{config('auditable.identifiers.user')};
            $data['date'] = date("Y-m-d H:i:s");
            $data['action'] = 'delete';

            Audit::create($data);
        });
    }
}
