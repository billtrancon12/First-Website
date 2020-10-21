function createTitle(){
    const li = document.createElement('li')
    li.setAttribute('class',"wds-global-footer-naruto_world_link")

    let content = document.createTextNode("Naruto World established since 2020")
    li.appendChild(content)
    document.getElementsByClassName('wds-global-footer-naruto_world_links')[0].appendChild(li)
}

function createContent(cont,index){
    const li = document.createElement('li')
    li.setAttribute('class','wds-global-footer-naruto_world_link')
    
    const link = document.createElement('a')
    link.setAttribute('href','#'+cont)
    const content = document.createTextNode(cont)
    link.appendChild(content)

    document.getElementsByClassName("wds-global-footer-naruto_world_links")[0].appendChild(li)
    document.getElementsByClassName("wds-global-footer-naruto_world_link")[index].appendChild(link)
}
function createNarutoWorld(){
    const link = document.getElementsByClassName("wds-global-footer-naruto_world")[0]
    if(localStorage.getItem("Login")==1){
        link.setAttribute("href","http://localhost:3000/FirstProject/html/success_login.html")
    }
    else{
        link.setAttribute("href","http://localhost:3000/FirstProject/html/index.html")
    }
}