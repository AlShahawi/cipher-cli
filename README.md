Cipher CLI Tool
==
The goal of this project is to implement encryption and decryption algorithms for strings.

## Installation
You can download this repository using the following commands:
```bash
git clone REPOSITORY_URL
cd cipher-cli
```

## Running Via Docker
If you're using docker run the following commands in order to run the command line tool:
```bash
docker build -t my-cipher .
docker run -it --rm --name my-running-cipher my-cipher
```
### Not using docker?
If you're not using docker you can install & run the application using the following commands:
```bash
composer install
php cipher
```
The tool will ask you for a string, algorithm and the method to encrypt or decrypt the given string. 

## TODO
1. (DONE) Implement Shift Encryption Algorithm (Caesar Cipher)
2. (DONE) Implement Matrix Encryption Algorithm (Hill Cipher)
3. (DONE) Write Unit Tests for both Shift and Matrix Algorithms
4. (DONE) Implement Decryption for both Shift and Matrix Algorithms
5. (DONE) Implement Command Line Tool
6. (DONE) Add Integration for Reverse Encrpyion Algorithm
7. (DONE) Add Reverse Encrpyion Algorithm for CLI Tool
