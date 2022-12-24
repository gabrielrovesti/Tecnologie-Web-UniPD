var checks = {
    nome:{
        message:"Inserire un nome lungo almeno 2 caratteri.",
        condition: function(str){
            return str.length>2;
        }
    },
    data:{
        message:"Inserire una data nel formato dd/mm/aaaa.",
        condition: function(str){
            return str.length>2;
        }
    },
    luogo:{
        message:"Inserire luogo lungo almeno 2 caratteri e senza numeri.",
        condition: function(str){
           return str.match('/\w{2}\w*/'); 
        }
    },
    altezza:{
        message:"Inserire un numero maggiore di 129.",
        condition: function(str){
            if(parseInt(str)){
                if(str>129){
                    return true;
                }
                return false;
            }
            return false;
        }
    },
    squadra:{
        message:"Inserire luogo lungo almeno 2 caratteri e senza numeri.",
        condition: function(str){
           return str.match('/\w{2}\w*/');
        }
    },
    maglia:{
        message:"Inserire un numero di almeno una cifra.",
        condition: function(str){
           return str.match('/\d\d*/');
        }
    },
    magliaNazionale:{
        message:"Inserire un numero di almeno una cifra.",
        condition: function(str){
           return str.match('/\d\d*/');
        }
    },
};

function addFieldsEvent(){

    let inputs    = document.getElementsByTagName('input');
    let selects   = document.getElementsByTagName('select');
    let textareas = document.getElementsByTagName('textarea');

    for (i = 0; i < inputs.length; i++) {
       inputs.item(i).addEventListener('blur',validateField);
    } 

    for (i = 0; i < selects.length; i++) {
        selects.item(i).addEventListener('blur',validateField);
    }

    for (i = 0; i < textareas.length; i++) {
        textareas.item(i).addEventListener('blur',validateField);
    }
    
}


function validateField(event){

    let name = event.target.getAttribute('name'); 
    let value = event.target.value;

    if(checks[name]){

        if(!checks[name].condition(value)){  //(┛◉Д◉)┛彡(exception) throw exception
            
            if(event.target.nextSibling){
              if(event.target.nextSibling.tagName == 'P')
                event.target.nextSibling.remove();
            
                console.info(event.target.nextSibling.tagName);
            }

            let newElement = document.createElement('p');
            newElement.classList.add('formError');
            newElement.innerHTML = checks[name].message;

            event.target.classList.toggle('inputError');

            event.target.setAttribute('aria-alert',checks[name].message);

            event.target.parentNode.insertBefore(newElement, event.target.nextSibling)
        }
    }
}

