$(document).ready(function(){
    const unitPrice = document.getElementById('unit-price').textContent
    const unitNumber = document.getElementById('unit-number').value
    const percent = document.getElementById('roi').textContent
    const availableUnit = document.getElementById('availUnit').textContent
    const payout = document.getElementById('payout').textContent
    const total = document.getElementById('total-price').textContent

    
    
$('#unit-number').on('input', (e)=>{
    e.preventDefault()
    const uNumber = e.target.value
    if(parseInt(availableUnit) < uNumber){
        alert('You have exceeded the available units for this farm');
        document.getElementById('unit-number').value = availableUnit
        var nPrice = availableUnit * unitPrice.replace(/,/g, '').trim()
        var nePrice = (nPrice).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        //calculating the percentage
        var percentage = (percent/100)*nPrice
        //adding the percentage and money of the customer
        var adding = (nPrice + percentage).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        //showing the customer final payment plus percentage return
        document.getElementById('payout').textContent =  adding
        //showing the customers payment fot the units bought
        document.getElementById('total-price').textContent =  nePrice
    }else{
        var nPrice = uNumber * unitPrice.replace(/,/g, '').trim()
        var nePrice = (nPrice).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        //calculating the percentage
        var percentage = (percent/100)*nPrice
        //adding the percentage and money of the customer
        var adding = (nPrice + percentage).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        //showing the customer final payment plus percentage return
        document.getElementById('payout').textContent =  adding
        //showing the customers payment fot the units bought
        document.getElementById('total-price').textContent =  nePrice
    }
   
})
})