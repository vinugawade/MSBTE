document.getElementById("clear_btn").addEventListener('click',()=>{
    if(confirm("Confirm About Clearing Process?")){
        document.getElementById("clear_btn").href="./DataBase/Clear_DB.php";
    }
});