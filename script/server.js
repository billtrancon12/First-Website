const mysql = require('mysql');
const express = require('express')
const cors = require('cors')
const app = express()
app.use(cors())

const con  = mysql.createConnection({
    host        :   'localhost',
    user        :   'liam',
    password    :   'LiamNgoan123@4',
    database    :   'Naruto'   
});

con.connect(function(err){
    if(!err) {
        console.log("Database is connected ... \n\n");  
    } else {
        console.log("Error connecting database ... \n\n");  
    }
});

let data = []

con.query('select * from characters', (err,rows) => {
    if(err) throw err;
    console.log('Data receive from database');
    data = [...rows]
});


app.listen(3001, () => {
    console.log("listening on port 3000")
})

/* get all the characters */ 
app.get('/allchar', (req, res) => {
    if(data.length > 0) {
        res.send(data)
        return
    }
    res.send("no result")
})


app.get('/:letter',(req,res)=>{
    const letter = req.params.letter
    /* filter characters */
    let char = data.filter((character) =>{  
        return character.name.substring(0,1).toLowerCase() === letter.toLowerCase()
    })
    if(char.length>0){
        res.send(char)
        return
    }
    res.send('No result')
})

app.get('/character/:name', (req,res) => {
    const name = req.params.name
    /* filter characters */
    let char = data.filter((character) =>{  
        return character.name.toLowerCase() === name.toLowerCase()
    })
    if(char.length>0){
        res.send(char)
        return
    }
    res.send('No result')
})
