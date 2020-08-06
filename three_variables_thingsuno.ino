#include <TheThingsNetwork.h>

// Set your AppEUI and AppKey
const char *appEui = "70B3D57ED0030F84";
const char *appKey = "E942E2186DD1B0366958A6DB88BD48C1";

#define loraSerial Serial1
#define debugSerial Serial

// Replace REPLACE_ME with TTN_FP_EU868 or TTN_FP_US915
#define freqPlan TTN_FP_EU868

TheThingsNetwork ttn(loraSerial, debugSerial, freqPlan);

void setup()
{
  loraSerial.begin(57600);
  debugSerial.begin(9600);

  // Wait a maximum of 10s for Serial Monitor
  while (!debugSerial && millis() < 10000)
    ;

  debugSerial.println("-- STATUS");
  ttn.showStatus();

  debugSerial.println("-- JOIN");
  ttn.join(appEui, appKey);
}

void loop()
{
  debugSerial.println("-- LOOP");
  
  int temp = (32.6 + random(-20,20)) * 100;
  int ant = 140;
  int val = random(-99,99);
  byte payload[5];
  payload[0] = (byte)((temp & 0xFF00) >> 8);
  payload[1] = (byte)((temp & 0x00FF) );
  payload[2] = (byte)(ant);
  payload[3] = (byte)((val & 0xFF00) >> 8);
  payload[4] = (byte)((val & 0x00FF) );

  //Serial.print(payload[2]);
  

  // Send it off
  ttn.sendBytes(payload, sizeof(payload));

  
  delay(10000);
}
