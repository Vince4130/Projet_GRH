/**
 * Fonction qui masque une div en fonction 
 * de son id
 * @param mixed id
 * 
 * @return [type]
 */
function cacheDiv(div_id) 
{   
    var div = document.getElementById(div_id);
    div.style.display = "none";
} 

/**
 * Permet d'effacer le contenu d'une div 
 * avec son id
 * @param mixed div
 * 
 * @return [type]
 */
function erase(div)
{
    var div = document.getElementById('div');
    div.value = "";
}


/**
 * Redirection vers la page précédente
 * @param mixed page
 * 
 * @return [type]
 */
function retour(page) {
    window.location.href = 'index.php?action='+page;
  } 
  
// /**
//  * Fonction pour afficher le texte passé en paramètre
//  * avec un décompte en secondes
//  * @param mixed text
//  * @param mixed sec
//  * 
//  * @return [type]
//  */
// function decompte(text, sec) 
// {     
//     if (sec >= 0) {
//         document.getElementById("succes").innerHTML = text+' redirection dans '+sec+'s';
//         setInterval(() => {
//             sec--;        
//             decompte();
//             document.getElementById("succes").innerHTML = text+' redirection dans '+sec+'s';
//         }, 1000);
//     } 
// }