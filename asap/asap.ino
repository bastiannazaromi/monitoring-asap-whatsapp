#include <Arduino.h>

// Wifi
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>

#define USE_SERIAL Serial
ESP8266WiFiMulti WiFiMulti;
WiFiClient client;
HTTPClient http;

// URL WEB IOT
String simpan = "http://sismosap.my.id/sensor/post?nilai=";

String respon;

// lcd
#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);
// SCL ---------------> D1
// SDA ---------------> D2
// VCC ---------------> VCC 5V
// GND ---------------> GND

// Library dfplayer
#include <SoftwareSerial.h>
#include <DFPlayer_Mini_Mp3.h>

SoftwareSerial mySerial(D3, D4); // rx tx dflayer

#define mq7pin A0

// millis
unsigned long waktuSebelumnya = 0;
unsigned long interval = 3000;

//variabel
int nilai;

boolean df_smoke = false;

void setup()
{
    Serial.begin(115200); // Komunikasi baud rate

    USE_SERIAL.begin(115200);
    USE_SERIAL.setDebugOutput(false);

    for (uint8_t t = 5; t > 0; t--)
    {
        USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
        USE_SERIAL.flush();
        delay(1000);
    }

    WiFi.mode(WIFI_STA);
    WiFiMulti.addAP("androidOne", "tanyatuhan"); // Sesuaikan SSID dan password ini

    Serial.println();

    for (int u = 1; u <= 5; u++)
    {
        if ((WiFiMulti.run() == WL_CONNECTED))
        {
            USE_SERIAL.println("WiFi Connected");
            USE_SERIAL.flush();
            delay(1000);
        }
        else
        {
            Serial.println("WiFi not Connected");
            delay(1000);
        }
    }

    lcd.init();
    lcd.backlight();
    lcd.setCursor(3, 0);
    lcd.print("MONITORING");
    lcd.setCursor(3, 1);
    lcd.print("ASAP ROKOK");

    //  Inisialisasi dfplayer sebagai suara
    mySerial.begin(9600);
    mp3_set_serial(mySerial);
    delay(10);
    mp3_set_volume(15);
    delay(1000);
}

void loop()
{
    readSmoke();

    // kirim data sensor ke website
    if ((WiFiMulti.run() == WL_CONNECTED))
    {
        USE_SERIAL.print("[HTTP] Memulai...\n");

        http.begin(client, simpan + (String) nilai);

        USE_SERIAL.print("[HTTP] Menyimpan data sensor ke database ...\n");
        int httpCode = http.GET();

        if (httpCode > 0)
        {
            USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

            if (httpCode == HTTP_CODE_OK)
            {
                respon = http.getString();
                USE_SERIAL.println("Respon : " + respon);
                delay(200);
            }
        }
        else
        {
            USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
        }
        http.end();
    }

    delay(1000);
}

void readSmoke()
{
  unsigned long waktuSekarang = millis();
  if (waktuSekarang - waktuSebelumnya >= interval)
  {
    // membaca nilai mq3
    nilai = analogRead(mq7pin);

    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Nilai : ");
    lcd.print(nilai);

    if (nilai > 400)
    {
      if (df_smoke == false) {
        mp3_play(1);

        df_smoke = true;
      }
      
      Serial.println("DILARANG MEROKOK");
    }
    else
    {
      df_smoke = false;
      Serial.println("tidak ada suara");
    }

    waktuSebelumnya = waktuSekarang;
  }
}
