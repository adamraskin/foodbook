<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		&nbsp;&nbsp;&nbsp;
		<a href="explore.php">Go Back</a>
		<br><br>
		<center><h2 id="title"></h2></center>
		<br><br>
		<center><button onclick="generateFirstPopulation(120)">Generate</button></center>
		<center><button onclick="selectForNextPop(population, fitnessVal); breedAndMutate(selection)">Next Population</button></center>
		<br><br><br>
		<p id="p" style="text-align:center"></p>
		<center>
			<table style="width:80%" border="1">
				<tr id="textRow">
				</tr>
				<tr id="fitnessRow">
				</tr>
			</table>
		</center>
	</body>
	<script>
		var password="HardToGuessPassword1234567890";
		var possible="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		document.getElementById("title").innerHTML="Phrase to guess: "+password;
		function generateFirstPopulation(arrayLength){
			
			var population=[];
			for(var i=0;i<=arrayLength-1;i++){
				population[i]=generateWord(password.length);
			}
			display(population, "textRow");
			fitness(population);
			window.population=population;
		}
		
		function generateWord(length){
			var word="";
			for(var i=0;i<=length-1;i++){
				word+=possible.charAt(Math.floor(Math.random()*possible.length));
			}
			return word;
		}
		
		function fitness(input){
			
			var fitnessVal=[];
			for(var t=0;t<=input.length-1;t++){
				fitnessVal[t]=0;
				
				if(password.length==input[t].length){
					for(var i=0;i<=password.length-1;i++){
						if(password.charAt(i)==input[t].charAt(i)){
							fitnessVal[t]++;
						}
					}
					
					fitnessVal[t]=fitnessVal[t]/password.length*100;
				}else{
					fitnessVal[t]=0;
				}
			}
			display(fitnessVal, "fitnessRow");
			window.fitnessVal=fitnessVal;
		}
		
		function display(inputArray, rowName){
			var deleteRow=document.getElementById(rowName);
			while (deleteRow.firstChild) {
					deleteRow.removeChild(deleteRow.firstChild);
			}
			var td=[];
			var row=document.getElementById(rowName);
			
			for(var t=0;t<=inputArray.length-1;t++){
				td[t]=document.createElement("td");
				td[t].innerHTML=inputArray[t];
				row.appendChild(td[t]);
			}
		}
		
		function selectForNextPop(inputArray, fitnessArray){
			var selection=[];
			var temp;
			var flag=1;
			var modArray=[inputArray, fitnessArray];
			while(flag==1){
				flag=0;
				for(var t=0;t<modArray[0].length-1;t++){
					if(modArray[1][t]<modArray[1][t+1]){
						temp=modArray[1][t];
						modArray[1][t]=modArray[1][t+1];
						modArray[1][t+1]=temp;
						temp=modArray[0][t];
						modArray[0][t]=modArray[0][t+1];
						modArray[0][t+1]=temp;
						flag=1;
					}
				}
			}
			for(var i=0;i<=Math.floor((inputArray.length-1)/20);i++){
				selection[i]=inputArray[i];
				var arrayPoint=i;
			}
			for(var i=arrayPoint+1;i<=arrayPoint+Math.floor((inputArray.length-1)/3);i++){
				selection[i]=inputArray[Math.floor(Math.random()*inputArray.length)];
			}
			window.selection=selection;
		}
		
		function breedAndMutate(selection){
			for(var i=selection.length;selection.length<population.length;i++){
				var wordMod1=selection[Math.floor(Math.random()*selection.length)];
				var wordMod2=selection[Math.floor(Math.random()*selection.length)];
				var resultWord="";
				for(var t=0;t<=wordMod1.length-1;t++){//problem here, breed less, use randoms to fill pop to have more diversity
					if(t%2==0){
						resultWord+=wordMod1[Math.floor(Math.random()*wordMod1.length)];
					}else{
						resultWord+=wordMod2[Math.floor(Math.random()*wordMod2.length)];
					}
				}
				selection[i]=resultWord;
			}
			for(var x;x<=Math.floor(selection.length);x++){
				selection[x][Math.floor(Math.random()*selection[x].length)] = possible.charAt(Math.floor(Math.random()*possible.length));
			}
			console.log(selection);
			window.population=selection;
			fitness(population);
			display(population, "textRow");
			display(fitnessVal, "fitnessRow");
		}
	</script>
</html>