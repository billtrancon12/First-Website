function redirLink(characters,index,page){
    const link = document.createElement('a')
    link.setAttribute('href','http://localhost:3000/FirstProject/html/foo.html')
    link.setAttribute('title',characters[index].name)
    if(index-page*50<=24){
        link.setAttribute('class','category_page-member-link-left')
    }
    else if(index-page*50<=49){
        link.setAttribute('class','category_page-member-link-right')
    }
    link.setAttribute('id',characters[index].name+index)
    const title = document.createTextNode(characters[index].name)
    link.appendChild(title)
    document.getElementsByClassName('category_of-each-character')[index-page*50].appendChild(link)
    document.getElementById(characters[index].name+index).addEventListener('click',function(){
        localStorage.setItem('char-index',index)
    })
}

function redirImg(characters,index,page){
    const link = document.createElement('a')
    link.setAttribute('href','http://localhost:3000/FirstProject/html/foo.html')
    link.setAttribute('title',characters[index].name+'_image')
    if(index-page*50<=24){
        link.setAttribute('class','category_page-member-img-link-left')
    }
    else if(index-page*50<=49){
        link.setAttribute('class','category_page-member-img-link-right')
    }
    link.setAttribute('id',characters[index].name+index+'_image')
    document.getElementsByClassName('category_of-img')[index-page*50].appendChild(link)
    document.getElementById(characters[index].name+index+'_image').addEventListener('click',function(){
        localStorage.setItem('char-index',index)
    })
    
    const img = document.createElement('img')
    const img_link = characters[index].image_link
    if(img_link.localeCompare(null)!=0){
        img.setAttribute('src',characters[index].image_link)
        link.appendChild(img)
    }
}

function createPgNum(number){
    //create a list for page number
    const olist = document.createElement('li')
    olist.setAttribute('class','category_for-page-number')
    olist.setAttribute('style','list-style-type:none')

    const num = document.createElement('a')
    num.setAttribute('href','http://localhost:3000/FirstProject/html/EachCharacter.html')
    num.setAttribute('class','category_page-number')
    num.setAttribute('id','page'+number)
    const numPage = document.createTextNode('['+number+']')
    num.appendChild(numPage)
    olist.appendChild(num)
    document.getElementsByClassName('list_of-all-pages')[0].appendChild(olist)
    document.getElementById('page'+number).addEventListener('click',function(){
        localStorage.setItem('page_number',number)
    })
}

function createHomePage(text,url){
    const homepage = document.createElement('a')
    homepage.setAttribute('href',url)
    homepage.setAttribute('id',text)
    const content = document.createTextNode(text)
    homepage.appendChild(content)
    document.getElementsByClassName('Homepage')[0].appendChild(homepage)
}

function createHomePageMenu(){
    if(localStorage.getItem("Login")==1){
        createHomePage("HomePage","http://localhost:3000/FirstProject/html/success_login.html")
    }
    else{
        createHomePage("HomePage","http://localhost:3000/FirstProject/html/index.html")
    }
    createHomePage("Games","#Games")
    createHomePage("TV","#TV")
    createHomePage("Movies","#Movies")
}

function createCharacter(characters,page){
    let page_number = parseInt(page)-1
    let index=page_number*50
    let split
    //Create a ul for character
    let ulist 
    let n
    if(characters.length-(page_number)*50<50){
        n = characters.length
    }
    else{
        n = (page_number+1)*50
    }
    for(index;index<n;index++){
        const olist = document.createElement('li')
        olist.setAttribute('class','category_of-each-character')
        const divImg = document.createElement('div')
        divImg.setAttribute('class','category_of-img')

        if(index%50==25 || index%50==0){
            ulist = document.createElement('ul')
            ulist.setAttribute('class','category_of-each-character-member')
            ulist.setAttribute('style','list-style-type:none')
            if(index%50==0){
                split = document.createElement('div')
                split.setAttribute('class','category_of-characters')
                split.setAttribute('id','left')
                document.getElementById('category_of-all-characters').appendChild(split)
                document.getElementById('left').appendChild(ulist)
                if(page==26){
                    split.setAttribute("style","display:inline-table;")
                }
            }
            else if (index%50==25){
                split = document.createElement('div')
                split.setAttribute('class','category_of-characters')
                split.setAttribute('id','right')
                document.getElementById('category_of-all-characters').appendChild(split)
                document.getElementById('right').appendChild(ulist)
                if(page==26){
                    split.setAttribute("style","display:inline-table;")
                }
            }
        }
        

        olist.appendChild(divImg)
        ulist.appendChild(olist)

        //Create a character image
        redirImg(characters,index,page_number)
        redirLink(characters,index,page_number)
        

    }
}

