<?php

namespace GMarineau\LaravelPwa\Services;

class MetaService
{
    public function render()
    {
        return "<?php \$config = (new \LaravelPWA\Services\ManifestService)->generate(); echo \$__env->make( 'laravelpwa::meta' , ['config' => \$config])->render(); ?>";
    }
}
