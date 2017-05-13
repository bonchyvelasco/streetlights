#include <SPI.h>
#include <UIPEthernet.h>


#define S0 0
#define S1 1
#define S2_G 2
#define S3_G 3
#define S2_Y 4
#define S3_Y 5
#define S2_R 2
#define S3_R 3
#define sensorOutR 6
#define sensorOutY 7
#define sensorOutG 8
#define dif 1000

int cred;
int cblue;
int cgreen;


int red1=0;
int yellow1=0;
int green1=0;
int red0=50;
int yellow0=50;
int green0=50;


const int stoplightID=1;

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0xF1 }; // RESERVED MAC ADDRESS
EthernetClient client;

IPAddress server(169,254,20,93);

IPAddress ip(169,254,20,31);
IPAddress subnet(255,255,0,0);

IPAddress gateway(169,254,0,0);

String data="";

void setup() {
      Serial.begin(9600);      
      pinMode(S0, OUTPUT);
      pinMode(S1, OUTPUT);
      pinMode(S2_R, OUTPUT);
      pinMode(S3_R, OUTPUT);      
      pinMode(S2_Y, OUTPUT);
      pinMode(S3_Y, OUTPUT);
      pinMode(S2_G, OUTPUT);
      pinMode(S3_G, OUTPUT);
      pinMode(sensorOutR, INPUT);
      pinMode(sensorOutY, INPUT);
      pinMode(sensorOutG, INPUT);
      digitalWrite(S0,HIGH);
      digitalWrite(S1,LOW);
      

      Ethernet.begin(mac,ip, gateway,subnet);



data = "";
}

int getcolor(int S2, int S3, int sensorOut){
  
      ///////////////// RED ///////////////////////
      digitalWrite(S2,LOW);
      digitalWrite(S3,LOW);
      cred = pulseIn(sensorOut, LOW);
      // red1 = map(red1, 1200,26000,255,0);
      
      Serial.print("R= ");//printing name
      Serial.print(cred);//printing RED color frequency
      Serial.print("  ");
      delay(200);
      
      
      //////////////// GREEN /////////////////////////
      digitalWrite(S2,HIGH);
      digitalWrite(S3,HIGH);
      cgreen = pulseIn(sensorOut, LOW);
      // green1 = map(green1, 2400,14000,255,0);
      
      Serial.print("G= ");//printing name
      Serial.print(cgreen);//printing RED color frequency
      Serial.print("  ");
      delay(200);
      
      
      //////////// // BLUE /// //   /////////////////
      digitalWrite(S2,LOW);
      digitalWrite(S3,HIGH);
      // Reading the output frequency
      
      cblue = pulseIn(sensorOut, LOW);
      // blue1 = map(blue1, 29000,600,255,0);
      
      // Printing the value on the serial monitor
      Serial.print("B= ");//printing name
      Serial.print(cblue);//printing RED color frequency
      Serial.println("  ");
      delay(500);
      if ((abs(cred)+abs(cblue)+abs(cgreen))<30){
         return 1; 
      }
      else{
         return 0; 
      }
     
}

void loop(){
  Serial.println("Red");
  red1 = getcolor(S2_R,S3_R,sensorOutR);
  Serial.println("Yellow");
  yellow1 = getcolor(S2_Y,S3_Y,sensorOutY);
  Serial.println("Green");
  green1 = getcolor(S2_G,S3_G,sensorOutG);
  Serial.println();
  Serial.println(red1);
  Serial.println(yellow1);
  Serial.println(green1);

  if ((red1!=red0)||(yellow1!=yellow0)||(green1!=green0)){
     Serial.print("AAAAA BIG CHANGE\n"); 

       data = "red=";  
       data.concat(red1);
       data.concat("&green=");
       data.concat(green1);
       data.concat("&yellow=");
       data.concat(yellow1);
       data.concat("&id=");
       data.concat(stoplightID);
  }

  if (data.length()>0){
    Serial.print("trying to send: ");
    Serial.println(data);
  if (client.connect(server,80)) { // REPLACE WITH YOUR SERVER ADDRESS
    Serial.println("hello");
    client.print("GET /streetlights/add.php?");
    client.print(data);
    client.println(" HTTP/1.1");
    client.println("Host: 169.254.20.93"); // SERVER ADDRESS HERE TOO

    client.println();
    red0=red1;
    yellow0=yellow1;
    green0=green1;
    delay(5000);
    client.stop();

  }

  else{
   Serial.println("Failed to connect to server"); 
    
  }

  data = "";
  }

delay(1000);
}




