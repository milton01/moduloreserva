int ledPin = 9;
int ledPin2 = 10;
int ledPin3 = 8;

char numero = '-';
void setup(){
  pinMode(ledPin, OUTPUT);
  pinMode(ledPin2, OUTPUT);
  pinMode(ledPin3, OUTPUT);
  Serial.begin(9600);
}

void loop(){
  if (Serial.available() > 0){
    numero = Serial.read();
  }
  
  if (numero != '-'){
    if (numero == 'D') {
      digitalWrite(ledPin, HIGH);
      digitalWrite(ledPin2, LOW);
      digitalWrite(ledPin3, LOW);
      delay(1000);
    }
    else if (numero == 'O'){
      digitalWrite(ledPin, LOW);
      digitalWrite(ledPin2, HIGH);
      digitalWrite(ledPin3, LOW);
      delay(1000);
    }
    else if (numero == 'L'){
      digitalWrite(ledPin, LOW);
      digitalWrite(ledPin2, LOW);
      digitalWrite(ledPin3, HIGH);
      delay(1000);
    }
    else if (numero == 'A'){
      digitalWrite(ledPin, LOW);
      digitalWrite(ledPin2, LOW);
      digitalWrite(ledPin3, LOW);
      delay(1000);
    }
  }
}


