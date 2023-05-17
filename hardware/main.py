import asyncio
import websockets
import bme280
import smbus2
from time import sleep
import RPi.GPIO as GPIO


GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(18, GPIO.OUT)
GPIO.setup(12, GPIO.OUT)

port = 1
address = 0x76 # Adafruit BME280 address. Other BME280s may be different
bus = smbus2.SMBus(port)
sleep(1)

bme280.load_calibration_params(bus,address)

async def send_temp():
        url = "ws://10.10.9.103:8000" # IP ADDRESS OF THE SERVER:PORT
        async with websockets.connect(url) as websocket:
                while True:
                        bme280_data = bme280.sample(bus,address)
                        humidity = bme280_data.humidity
                        pressure = bme280_data.pressure
                        temperature = bme280_data.temperature
                        if temperature > 27:
                                GPIO.output(12, GPIO.HIGH)
                        elif temperature < 26:
                                GPIO.output(12, GPIO.LOW)
                                GPIO.output(18, GPIO.HIGH)
                        else:
                                GPIO.output(12, GPIO.LOW)
                                GPIO.output(18, GPIO.LOW)

                        print(temperature)

                        await websocket.send(str(temperature))
                        sleep(1)


if __name__ == "__main__":
    asyncio.run(send_temp())
