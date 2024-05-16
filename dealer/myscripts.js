const http = require("http");
const url = require("url");
const server = http.createServer((req, res) => {
    if(req.url =="/"){
        res.write("you are on the homepage");
        res.end();
    }else{
        let parsedURL = url.parse(req.url);
        res.write("Hi!,  " + parsedURL.pathname);
        res.end();
    }
    
});


server.listen(3501,()=>{
    console.log("Server is running on port 3501.");
})