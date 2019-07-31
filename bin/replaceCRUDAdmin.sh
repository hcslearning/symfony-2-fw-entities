# Acomoda el CRUD generado por Symfony 4
# bajo orden propio de proyecto

adminZone="admin"
entityName="$1"
entitySnake="$2"
# si se pasa como 3er argumento rm, se borraran los archivos generados por Symfony CRUD
borrar=${3:-no} # default value a no. Se espera que sea "rm" para borrar los archivos

controllerFileOrig="./src/Controller/${entityName}Controller.php"
controllerFile="./src/Controller/Admin/${entityName}Controller.php"
templateDirOrig="./templates/$entitySnake"
templateDir="./templates/admin/$entitySnake"
formFile="./src/Form/${entityName}Type.php"
currentDir=$PWD

echo "ENTITY CamelCase y snake_case"
echo "$entityName"
echo "$entitySnake"
echo
echo "CURRENT DIR"
echo "$PWD"
echo
echo "CONTROLLER"
echo "$controllerFileOrig"
echo "$controllerFile"
echo 
echo "TEMPLATES"
echo "$templateDirOrig"
echo "$templateDir"
echo
echo "FORMULARIOS"
echo "$formFile"
echo
echo

if [ "rm" = $borrar ]; then
    rm "$controllerFile"
    rm -rf "$templateDir"
    rm "$formFile"
    echo "Se han borrado los templates y el archivo Controlador"
    echo
    exit
fi

# Mueve los archivos y directorios
mv $controllerFileOrig $controllerFile
mv $templateDirOrig $templateDir 

# Reemplaza lo necesario en el controlador
sed -i "s|namespace App\\\Controller;|namespace App\\\Controller\\\Admin;|" $controllerFile
sed -i "s|$this->render('|$this->render('admin/|" $controllerFile
sed -i "0,\|@Route(\"/|s||@Route(\"/$adminZone/|" $controllerFile

# Reemplaza lo necesario en los templates
find $templateDir -type f -exec sed -i "s|{% extends 'base.html.twig' %}|{% extends 'admin/base.html.twig' %}|" {} \;
find $templateDir -type f -exec sed -i "s|{{ include('$entitySnake/|{{ include('admin/$entitySnake/|" {} \;
#find $templateDir -type f -exec sed -i "s|||" {} \;


