function Decoder(bytes, port) {
 
  var temp = ((bytes[0] << 8) + bytes[1])/100; // reconstructs the temperature value from the first two bytes sent from the things uno
  var count = bytes[2];
  var val = ((bytes[3] << 8) + bytes[4])/100; // reconstructs the value from the third and forth byte sent from the things uno
  
  return{ 
    temperature: temp,
    count: count,
    value: val
  } // returns the values temp, count and val in the json object with keys temperature, count and value respectively
}