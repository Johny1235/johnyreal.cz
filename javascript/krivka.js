function vypocet()
{
    var m = parseFloat(document.getElementById('hmotnost').value);
    var C = parseFloat(document.getElementById('odpor').value);
    var S = parseFloat(document.getElementById('plocha').value);
    var p = parseFloat(document.getElementById('hustota').value);
    var v = parseFloat(document.getElementById('rychlost').value);
    
    document.getElementById('suma').value = (9.81 * m) + 0.5 * C * S * p * (v * v)

    if(document.getElementById('suma').value < 0) 
    {
        document.getElementById('suma').value = 0
    }
}