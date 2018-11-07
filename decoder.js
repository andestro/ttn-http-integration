function Decoder(bytes, port) {
 
  var temp = ((bytes[0] << 8) + bytes[1])/100; // reconstructs the temperature value from the first two bytes sent from the arduino
  var count = bytes[2];
  
  return{ 
    temperature: temp,
    count: count
  } // returns the values temp and count in the json object with keys temperature and count respectively
}