function createDisplay(user){
    displayUserInfo(user.name,"name")
    displayUserInfo(user.birthdate,"birthdate")
    displayUserInfo(user.email,"email")
    displayUserInfo(user.phone_number,"phone_number")
}

function displayUserInfo(info,type){
    const modifiedString = new modifyString(type);
    
    const div  = document.createElement("div")
    div.setAttribute("class","wds-update_account-field")
    div.setAttribute("id",type+"_update_account")
    
    const form = document.createElement("form")
    form.setAttribute("class","user_info")
    form.setAttribute("id",type+"_info")
    form.setAttribute("title","user_"+type)
    form.setAttribute("action","http://localhost:3000/FirstProject/php/update_account.php")
    form.setAttribute("method","POST")

    const label = document.createElement("label")
    label.setAttribute("for",type)
    const textNode = document.createTextNode(modifiedString.toCapitalize())
    label.appendChild(textNode)

    //Create a input field 
    const input = document.createElement("input")
    input.setAttribute("class","input_display")
    input.setAttribute("type","text")
    input.setAttribute("value",info)
    input.setAttribute("name",type)
    input.setAttribute("id","input_"+type)
    input.setAttribute("style","margin-top:100px;")
    input.setAttribute("disabled",false)

    //Create a submit button
    const submit = document.createElement("input")
    submit.setAttribute("class","temporary_submit_button")
    submit.setAttribute("id",type+"_submit")
    submit.setAttribute("type","submit")
    submit.setAttribute("value","Save")
    submit.setAttribute("style","display:none")

    // Create a temporary button that can modify the name field
    const button = document.createElement("button")
    button.setAttribute("class","temporary_button")
    button.setAttribute("id",type+"_button")
    button.setAttribute("value",type)
    const text = document.createTextNode("Change")
    button.appendChild(text)

    button.addEventListener("click",function(event){
        const type = event.target.id
        document.getElementById(type).setAttribute("style","display:none")
        const parent = document.getElementById(type).parentNode
        parent.childNodes[0].childNodes[1].removeAttribute("disabled")
        parent.childNodes[0].childNodes[2].removeAttribute("style")
    })

    form.appendChild(label)
    form.appendChild(input)
    form.appendChild(submit)
    
    document.getElementById("main_content").appendChild(div)
    document.getElementById(type+"_update_account").appendChild(form)
    document.getElementById(type+"_update_account").appendChild(button)
}

class modifyString{
    constructor(str){
        this.string = str
    }
    toCapitalize(){
        return this.string.charAt(0).toUpperCase() + this.string.slice(1)
    }
}