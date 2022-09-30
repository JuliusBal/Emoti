newElement = function(){
    if (document.getElementById("capacityInput").value === '' || document.getElementById("priceInput").value === '') {
        alert("Please enter room capacity and price");
    }  else {

        if(document.getElementById("result").innerHTML == '')
        {
            var result = 0;
        } else {
            var result = parseInt(document.getElementById("result").innerHTML);
        }
        var inputCapacityVal = document.getElementById("capacityInput").value;
        var inputPriceVal = document.getElementById("priceInput").value;

        const htmlBlock = document.createElement("div");
        htmlBlock.classList.add('mt-2');
        htmlBlock.innerHTML = `
                    <input type="number" name='rooms[${result}][capacity]' value="${inputCapacityVal}">
                    <input type="number" name="rooms[${result}][price]" value="${inputPriceVal}">
                    <button class="close btn btn-danger" type="button">Remove</button>
                    <br/>
                `;
        document.getElementById("capacities").appendChild(htmlBlock);

        var n_isADomElement = document.getElementById("result");
        let v = +n_isADomElement.innerText

        if (v != 10) {
            v++;
            n_isADomElement.innerText = v;
        }
    }

    document.getElementById("capacityInput").value = "";
    document.getElementById("priceInput").value = "";

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function () {
            var div = this.parentElement;
            div.remove();
            document.getElementById('result').innerText = result -1;
        }
    }
};


var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
    close[i].onclick = function () {
        var div = this.parentElement;
        div.remove();
    }
}

addDailyPrices = function(id){
    let weekList = document.getElementsByClassName("daily-prices-" + id);
    weekList[0].classList.remove("hidden");

    let button = document.getElementById("dailyPriceButton" + id);
    button.remove();
}
