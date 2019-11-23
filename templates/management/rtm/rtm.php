<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>RTMViewer</title>
    </head>
    <body style="background-image: url('wind.jpg');background-size: cover">
        <?php
            ob_get_clean();
        ?>
        <div class="container"> 
            <h1>WP</h1>  
            <table id="rtmdata" class="table table-dark table-hover">
            </table>
        </div>
        <script>
            windparks = [
                {name:["Българево",],      url:'http://46.55.211.226:8732/ServiceDoWork/DoWork?_=1553674569477'},
                {name:["Евклипс",],        url:'http://82.137.74.235:8732/ServiceDoWork/DoWork?_=1553674569477'},
                {name:["Зевс Бонус",],     url:'http://84.43.190.175:8732/ServiceDoWork/DoWork?_=1553674569477'},
                {name:["Милениум",],       url:'http://217.79.95.253:8732/ServiceDoWork/DoWork?_=1553674569477'},
                {name:["Еко Енерджи",],    url:'http://46.252.51.133:8732/ServiceDoWork/DoWork?_=1553674569477'}, 
                {name:["Микон1","Микон2","Микон3",],    url:'http://79.100.160.168:8732/ServiceDoWork/DoWork?_=1553689027886'}, 
                {name:["ЛонгЕм",],         url:'http://79.100.161.99:8732/ServiceDoWork/DoWork?_=1553674569477'},
                {name:["Хаос",],           url:'http://178.16.129.188:8732/ServiceDoWork/DoWork?_=1553674569477'},  
                {name:["Видно",],          url:'http://46.55.214.50:8732/ServiceDoWork/DoWork?_=1553674569477'},
                {name:["Сити Д", "Ник Билдинг",],    url:'http://46.55.211.169:8732/ServiceDoWork/DoWork?_=1553764022443'},  
                {name:["БЗ Експорт",],     url:'http://46.55.211.26:8732/ServiceDoWork/DoWork?_=1553772770319'},
                {name:["Цид Атлас",],      url:'http://46.55.240.17:8732/ServiceDoWork/DoWork?_=1553674569477'},  
                {name:["Каварна Ийст Г5",],   url:'http://46.55.211.214:8737/ServiceDoWork/DoWork?_=1553764022443'},    
                {name:["Арко",],           url:'http://46.55.211.156:8732/ServiceDoWork/DoWork?_=1553674569477'}, 
                {name:["ЛонгМан Г1+Г2","ЛонгМан Г4","ЛонгМан Г3",],        url:'http://46.55.211.214:8736/ServiceDoWork/DoWork?_=1553764022443'},          
                {name:["Вега KAV01+KAV02","Вега KAV03+KAV06","Вега KAV04+KAV05","Вега KAV07",],           url:'http://46.55.211.214:8733/ServiceDoWork/DoWork?_=1553764022443'},  
                {name:["Каварна KAV08+KAV09","Каварна KAV10+KAV11",],      url:'http://46.55.211.214:8732/ServiceDoWork/DoWork?_=1553764022443'},       
                {name:["Гимназия KAV12+KAV13","Гимназия KAV14+KAV15"],       url:'http://46.55.211.214:8734/ServiceDoWork/DoWork?_=1553764022443'},    
                {name:["Божурец KAV16",],      url:'http://46.55.211.214:8735/ServiceDoWork/DoWork?_=1553764022443'},    
                {name:["Храброво",],       url:'ws://212.5.144.3:8732'},
            ]
            var datacells = [
                ['12','13','14','6','7','8'],
                ['52','53','54','46','47','48'],
                ['92','93','94','86','87','88'],
                ['132','133','134','126','127','128'],
            ]
//Fetch the data for a question which the REST API provides
            function fetchData(url,position){
                // Fetch data from the url
                fetch(url).then(response => {
                    if (!response.ok) {
                        throw Error(response.statusText);
                    }
                    return response.json();
                }).then(data => {
                    // Work with JSON data here
                    let powerrow = document.getElementById(position);
                    let powername = document.getElementById(position+100);
                    for(n=0;n<datacells.length;n++){
                        let cell_a = data[datacells[n][0]];
                        let cell_r = data[datacells[n][1]];
                        let cell_s = data[datacells[n][2]];
                        let cell_uab = data[datacells[n][3]];
                        let cell_ubc = data[datacells[n][4]];
                        let cell_uac = data[datacells[n][5]];

                        writeData(position,cell_a,cell_r,cell_s,cell_uab,cell_ubc,cell_uac);
                        
                    }
                    powerrow.className = "table-success";    
                    powername.className = "alert-success";
                }).catch(err => {
                    //console.log(err);
                    let powerrow = document.getElementById(position);
                    let powername = document.getElementById(position+100);
                    let active = document.getElementById(position+1000);

                    active.innerHTML = "No Data!";
                    powerrow.className = "table-danger";
                    powername.className = "alert-danger";
                    active.className = "alert-danger";

                    setTimeout(Reload,10000);
                    // Do something for an error here
                });
            }
            function Reload(){
                location.reload();
            }

            function writeData(position,cell_a,cell_r,cell_s,cell_uab,cell_ubc,cell_uac){

                //console.log(cell_a,cell_r, cell_s,cell_uab,cell_uac,cell_ubc);
                if(cell_a){
                    let active = document.getElementById(position+n*100+1000);
                    active.innerHTML ="P"+(n+1)+" = " + Math.floor(cell_a/1000) + " kW" ;
                    if(cell_a<=0){
                        active.className = "alert-warning";
                    }else{
                        active.className = "alert-success";
                    }
                }
                if(cell_r){
                    let reactive = document.getElementById(position+n*100+2000);
                    reactive.innerHTML ="Q"+(n+1)+" = " + Math.floor(cell_r/1000) + " kVar" ;
                    if((cell_r/1000)>200){
                        reactive.className = "alert-danger";
                    }else{
                        reactive.className = "alert-success";
                    }
                }
                if(cell_s){
                    let cosphy = document.getElementById(position+n*100+3000);
                    cosphy.innerHTML ="cos φ"+(n+1)+" = " + Math.abs(cell_a/cell_s).toFixed(1);
                    if((cell_a/cell_s)<0.5){
                        cosphy.className = "alert-danger";
                    }else{
                        cosphy.className = "alert-info";
                    }
                }
                if(cell_uab){
                    let uab = document.getElementById(position+n*100+4000);
                    uab.innerHTML ="Uab"+(n+1)+" = " + Math.floor(cell_uab) + " V" ;
                    if(cell_uab<=20000){
                        uab.className = "alert-danger";
                    }else{
                        uab.className = "alert-success";
                    }
                }
                if(cell_ubc){
                    let ubc = document.getElementById(position+n*100+5000);
                    ubc.innerHTML ="Ubc"+(n+1)+" = " + Math.floor(cell_ubc) + " V" ;
                    if(cell_ubc<=20000){
                        ubc.className = "alert-danger";
                    }else{
                        ubc.className = "alert-success";
                    }
                }
                if(cell_uac){
                    let uac = document.getElementById(position+n*100+6000);
                    uac.innerHTML ="Uac"+(n+1)+" = " + Math.floor(cell_uac) + " V" ;
                    if(cell_uac<=20000){
                        uac.className = "alert-danger";
                    }else{
                        uac.className = "alert-success";
                    }
                }
            }

            function createTable(){
                table = document.getElementById("rtmdata");

                for(i=0;i<windparks.length;i++){
                    let newline = document.createElement("tr");
                    let namecell = document.createElement("td");
                    let powercell = document.createElement("td");
                    let repowercell = document.createElement("td");
                    let cosPhy = document.createElement("td");
                    let phasevoltage = document.createElement("td");
                    let u_ab = document.createElement("td");
                    let u_bc = document.createElement("td");
                    let u_ac = document.createElement("td");
                    newline.id = i;
                    namecell.id = i+100;
                    //Create windparks data cells
                    for(n=0;n<4;n++){
                        //name cells
                        let name = document.createElement("tr");
                        name.id = i+((n+2)*100);
                        namecell.appendChild(name);
                        
                        //active power cells
                        let active = document.createElement("tr");
                        active.id = i+n*100+1000;
                        powercell.appendChild(active);
                        
                        //reactive power cells
                        let reactive = document.createElement("tr");
                        reactive.id = i+n*100+2000;
                        repowercell.appendChild(reactive);

                        let cosphy = document.createElement("tr");
                        cosphy.id = i+n*100+3000;
                        cosPhy.appendChild(cosphy);
                    // the 3 phase voltage cells
                        let uab = document.createElement("tr");
                        uab.id = i+n*100+4000;
                        u_ab.appendChild(uab);

                        let ubc = document.createElement("tr");
                        ubc.id = i+n*100+5000;
                        u_bc.appendChild(ubc);

                        let uac = document.createElement("tr");
                        uac.id = i+n*100+6000;
                        u_ac.appendChild(uac);
                    }                    

                    newline.appendChild(namecell);
                    newline.appendChild(powercell);
                    newline.appendChild(repowercell);
                    newline.appendChild(cosPhy);
                    newline.appendChild(u_ab);
                    newline.appendChild(u_bc);
                    newline.appendChild(u_ac);

                    table.appendChild(newline);
                } 
            }

            function getNames(){
                for(i=0;i<windparks.length;i++){
                    let name = windparks[i]["name"];
                    for(j=0;j<name.length;j++){
                            document.getElementById(i+((j+2)*100)).innerHTML = name[j];
                        }
                    document.getElementById(i+1000).innerHTML = "No connection!";
                }
            } 

            var Connected = false;
            var hrabcells = [
                ['12','13','14','7','8','6'],
                ['32','33','34','27','28','26'],
                ['52','53','54','47','48','46'],
                ['72','73','74','67','68','66'],
            ];
            function fetchHrabrovo(url){
                let ws = url;
                if(!Connected){
                    socket = new WebSocket(ws);
                    socket.onopen = function() {
                        socket.send('Request for data');
                    };           
                }else{
                    socket.send('Request for data');
                }

                socket.onclose = function() {
                    Connected = false;
                }

                socket.onmessage = function(s) {
                    Connected = true;
                    let data = JSON.parse(s.data);
                    let position = windparks.length-1;
                    //console.log(position);
                    let powerrow = document.getElementById(position);
                    let powername = document.getElementById(position+100);
                    for(n=0;n<hrabcells.length;n++){
                        let cell_a = data[hrabcells[n][0]].SampleValue//[SampleValue];
                        let cell_r = data[hrabcells[n][1]].SampleValue;
                        let cell_s = data[hrabcells[n][2]].SampleValue;
                        let cell_uab = data[hrabcells[n][3]].SampleValue;
                        let cell_ubc = data[hrabcells[n][4]].SampleValue;
                        let cell_uac = data[hrabcells[n][5]].SampleValue;

                        writeData(position,cell_a,cell_r, cell_s,cell_uab,cell_ubc,cell_uac);
                        
                    }
                    powerrow.className = "table-success";    
                    powername.className = "alert-success";
                }
            }

            function getAllRTM(){
                for(i=0;i<windparks.length-1;i++){
                    let url = windparks[i]["url"];
                    fetchData(url,i);
                }
                let hrabrovo = windparks[windparks.length-1]["url"];//'ws://212.5.144.3:8732'//windparks[windparks.length-1]["url"];
                fetchHrabrovo(hrabrovo);
            } 
            createTable();
            getNames();
            setInterval(getAllRTM, 500);
        </script>
    </body>
</html>