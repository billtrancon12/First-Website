function createUserDropdown(login){
    if(login==1){
        createAccManage()        
    }
    else{
        createAuthorization();
    }
}

function createAccManage(){
    createMyAccount()
    createSetting()
    createLogOut()
}

function createLogOut(){
    const li = document.createElement("li")
    li.setAttribute("class","dropdown_log-out")

    const div = document.createElement("div")
    div.setAttribute("class","log_out")

    const link = document.createElement("a")
    link.setAttribute("href","#LogOut")
    link.setAttribute("rel","nofollow")
    link.setAttribute("data-trachking-label","log-out")
    link.setAttribute("class","log_out-link")

    const text = document.createTextNode("Log out")
    link.appendChild(text)

    link.addEventListener('click',function(){
        localStorage.setItem("Login",0)
        window.location.href = "http://localhost:3000/FirstProject/html/index.html"
    })

    div.appendChild(link)
    li.appendChild(div)
    document.getElementsByClassName("list-of-dropdown_contents")[0].appendChild(li)
}

function createSetting(){
    const li = document.createElement("li")
    li.setAttribute("class","dropdown_setting")


    const div = document.createElement("div")
    div.setAttribute("class","account_setting")

    const link = document.createElement("a")
    link.setAttribute("href","#Setting")
    link.setAttribute("rel","nofollow")
    link.setAttribute("data-trachking-label","setting")
    link.setAttribute("class","account_setting-link")

    const text = document.createTextNode("Setting")
    link.appendChild(text)

    div.appendChild(link)
    li.appendChild(div)
    document.getElementsByClassName("list-of-dropdown_contents")[0].appendChild(li)
}

function createMyAccount(){
    const li = document.createElement("li")
    li.setAttribute("class","dropdown_my-account")

    const div = document.createElement("div")
    div.setAttribute("class","my-account")

    const link = document.createElement("a")
    link.setAttribute("href","http://localhost:3000/FirstProject/php/my_account.php")
    link.setAttribute("rel","nofollow")
    link.setAttribute("data-trachking-label","my-account")
    link.setAttribute("class","my-account_link")

    const text = document.createTextNode("My Account")
    link.appendChild(text)

    div.appendChild(link)
    li.appendChild(div)
    document.getElementsByClassName("list-of-dropdown_contents")[0].appendChild(li)
}

function createAuthorization(){
    createSignIn()
    createRegister()
}

function createSignIn(){
    const li = document.createElement("li")
    li.setAttribute("class","dropdown_sign-in")
    
    const link = document.createElement("a")
    link.setAttribute("href","http://localhost:3000/FirstProject/php/sign_in.php")
    link.setAttribute("rel","nofollow")
    link.setAttribute("data-tracking-label","account-sign-in")
    link.setAttribute("class","button_sign-in")

    const text = document.createTextNode("Sign in")
    link.appendChild(text)

    li.appendChild(link)

    document.getElementsByClassName("list-of-dropdown_contents")[0].appendChild(li)
}

function createRegister(){
    const li = document.createElement("li")
    li.setAttribute("class","dropdown_register")
    
    const link = document.createElement("a")
    link.setAttribute("href","http://localhost:3000/FirstProject/php/register.php")
    link.setAttribute("rel","nofollow")
    link.setAttribute("data-tracking-label","account-sign-in")
    link.setAttribute("class","button_register")

    const text = document.createTextNode("Register")
    link.appendChild(text)

    li.appendChild(link)

    document.getElementsByClassName("list-of-dropdown_contents")[0].appendChild(li)
}
