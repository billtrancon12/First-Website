function charInfo(tag,nameTag,attribute,data,textNode){
    const object = document.createElement(tag)
    object.setAttribute(attribute,nameTag)
    const createTextNode = document.createTextNode(textNode)
    const objectRoot = document.getElementById('main_content')
    if(tag.localeCompare('p')==0){
        if(textNode.localeCompare(null)!=0){
            object.appendChild(createTextNode)
        }
    }
    if(data.localeCompare(null)!=0 && nameTag.localeCompare(null)!=0){
        objectRoot.appendChild(object)
    }
}
function charInfos(characters,index){
    charInfo('p','name','class',characters[index].name,'Name: '+characters[index].name)
    charInfo('p','sex','class',characters[index].sex,'Sex: '+characters[index].sex)
    charInfo('p','birthdate','class',characters[index].birthdate,'Birthdate: '+characters[index].birthdate)
    charInfo('p','height','class',characters[index].height,'Height: '+characters[index].height)
    charInfo('p','weight','class',characters[index].weight,'Weight: '+characters[index].weight)
    charInfo('p','blood_type','class',characters[index].blood_type,'Blood type: '+characters[index].blood_type)
    charInfo('p','affiliation','class',characters[index].affiliation,'Affiliation: '+characters[index].affiliation)
    charInfo('img',characters[index].image_link,'src','undefined','undefined')
}
function returnCharIndex(){
    return localStorage.getItem('char-index')
}