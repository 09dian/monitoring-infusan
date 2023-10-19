#include "HX711.h"
#include "DHT.h"
#define DHTTYPE DHT11
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
WiFiClient client;
DHT dht(DHTPIN, DHTTYPE);
int buttonpin = D1; // Tentukan pin untuk tombol tekan
#define DHTPIN D2
const int LOADCELL_DOUT_PIN = D3;
const int LOADCELL_SCK_PIN = D4;
int val;       // Variabel numerik
int count = 0; // Variabel penghitung
// Pengaturan WiFi
const char *ssid = "Nokia";       // Ganti dengan nama hotspot Anda
const char *pass = "12345678910"; // Ganti dengan password Anda
const char *ip_server = "192.168.237.85"; //ip computer atau laptop
void setup()
{
    WiFi.begin(ssid, pass);
    dht.begin();
    // Periksa koneksi
    WiFi.begin(ssid, pass);
    while (WiFi.status() != WL_CONNECTED)
    {
        delay(500);
        Serial.print("Belum terhubung");
        Serial.print("\n");
    }
    // Jika terhubung
    Serial.print("Terhubung ke WiFi");
    Serial.print("\n");
    pinMode(buttonpin, INPUT);
    Serial.begin(9600); // Inisialisasi komunikasi serial
}

void loop()
{
    val = digitalRead(buttonpin); // Periksa status tombol
    if (val == HIGH)              // Jika tombol ditekan, tambahkan penghitung dan tampilkan nilainya
    {
        count++;
        if (count > 3)
        {
            count = 1; // Reset penghitung menjadi 1 jika nilainya melebihi 3
        }

        // Kirim data ke database XAMPP
        const int port = 80;
        // Periksa koneksi ke database
        if (!client.connect(ip_server, port))
        {
            Serial.print("Gagal terhubung ke database");
            Serial.print("\n");
            return;
        }
        else
        {
            Serial.print("\n");
            Serial.print("Terhubung ke database");
        }
        // Jika berhasil terhubung, kirim data ke database XAMPP
        String Link;
        HTTPClient http;
        Link = "http://" + String(ip_server) + "/jsn_imfusan/auth/tj/" + String(count);
        // Eksekusi variabel di atas
        http.begin(client, Link);
        http.GET();
        http.end();
        delay(500);
    }

    delay(2000);
    // DHT22 mengirimkan paling banyak satu pengukuran setiap 2 detik
    float h = dht.readHumidity();
    // Baca kelembaban dalam persen
    float t = dht.readTemperature();
    // Baca suhu dalam derajat Celsius
    float f = dht.readTemperature(true);
    // true mengembalikan suhu dalam Fahrenheit

    if (isnan(h) || isnan(t) || isnan(f))
    {
        Serial.println(F("Penerimaan gagal"));
        return;
        // Kembalikan error jika ESP32 tidak menerima pengukuran apapun
    }

    Serial.print("Kelembaban: ");
    Serial.print(h);
    Serial.print("%  Suhu: ");
    Serial.print(t);
    Serial.print("°C, ");
    Serial.print(f);
    Serial.println("°F");

    // kirim data ke databes xampp
    const int port = 80;
    // cek konek ke data base
    if (!client.connect(ip_server, port))
    {
        Serial.print("Gagal connect Ke database");
        Serial.print("\n");
        return;
    }
    else
    {
        Serial.print("\n");
        Serial.print("Terhubung ke data base");
    }
    // jika berhasil terhubung kirim data ke database xampp

    String Link;
    HTTPClient http;
    Link = "http://" + String(ip_server) + "/jsn_imfusan/auth/posdata/" + String(t) + "/" + String(h);
    // jalankan variabel di atas
    http.begin(client, Link);
    http.GET();
    http.end();
    delay(500);
}


//dibuat dengan penuh cinta di garut 2023
