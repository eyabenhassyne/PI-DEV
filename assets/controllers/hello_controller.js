import  {  Controller  }  from  '@hotwired/stimulus' ;

/*
* Ceci est un exemple de contrôleur Stimulus !
*
Tout élément possédant un attribut data-controller="hello" provoquera une réaction.
* Ce contrôleur doit être exécuté. Le nom « hello » provient du nom du fichier :
* hello_controller.js -> "bonjour"
*
* Supprimez ce fichier ou adaptez-le à votre usage !
*/
export  default  class  extends  Controller  {
    connecter ( )  {
        this.element.textContent = ' Bonjour Stimulus ! Modifiez - moi dans assets/controllers/hello_controller.js ' ;  
    }
}