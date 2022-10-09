<?php
namespace Inadores\Autorizador;

use Illuminate\Http\Request;

class Controladores
{
    /**
     * lista la carpeta de controladores y sus funciones y l
     *
     * @return array
     */
    public static function todos($dir = '../app/Http/Controllers', $alcances = ['public']): array
    {
        $permisos = array();
        $directorio = opendir($dir);
        if (!$directorio) {
            throw("El directorio \"$dir\" no existe");
            //return ['message' => "El directorio \"$dir\" no existe"];
        }
        $es_archivo_php = fn($archivo) => 'php' == pathinfo($archivo, PATHINFO_EXTENSION);

        $getController = fn($archivo) => str_replace('.php', '', $archivo);

        $getFunctions = function($dir, $archivo, $alcances)
        {
            $getFuncion = function($linea, $alcances) 
            {
                foreach($alcances as $alcance)
                {
                    $busqueda = "$alcance function";
                    if(!str_starts_with($linea, $busqueda)){continue;}
                    $fn = explode('(', $linea);
                    $funcion = str_replace($busqueda, '', $fn[0]);
                    return trim($funcion);
                }
                return false;
            };
            $funciones = array();
            $fp = fopen("$dir/$archivo", 'r');
            //if ($fp) {return [];}
            while(($linea = fgets($fp)) !== false)
            {
                $linea = trim($linea);
                $funcion = $getFuncion($linea, $alcances);
                if($funcion){$funciones[] = $funcion;}
            }

            fclose($fp);
            return $funciones;
        };

        while (($archivo = readdir($directorio)) !== false) 
        {
            if(!$es_archivo_php($archivo)){continue;}//salta el ciclo
            $controller = $getController($archivo);//obtengo el nombre del controlador
            $permisos[$controller] = $getFunctions($dir, $archivo, $alcances);//nombre de las funciones del controlador
        }
        closedir($directorio);
        return $permisos;
    }    

    public static function validar(Request $request):bool
    {
        $validar = new Validador($request->user()->id, $request->route()->action['controller']);
        
        return ($validar->porAccion() || $validar->porRol());
    }
}