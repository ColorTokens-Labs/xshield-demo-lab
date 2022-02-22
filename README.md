# xshield-demo-lab

Designed for our valued partners, this repo describes a simple but 
comprehensive lab environment to showcase various Xshield use cases.

The demo lab consists of 5 Linux VMs and 2 Windows 10 workstations. 
The Linux VMs are configured as a single 3-tier application, an 
all-in-one LAMP-based application, and one spare server.  The lab 
can be deployed on any public cloud (AWS, Azure, GCP, etc.), or 
on-premise (VMware, QNAP, etc.).  In cloud environments you can 
deploy Windows Server 2016+ instances with the desktop GUI to act 
as the client systems.

![Demo lab diagram](docs/images/xshield-demo-lab.png)

> _NOTE:_  All systems must be deployed on the same network.
You may use multiple subnets but they must be directly connected.

Please refer to this [guide](3-tier-app) to setup the 3-tier 
IceHRM application.

For the Simple Web App, you can just deploy nginx on a Linux server.
For example, on a Ubuntu server this would be:

```
sudo apt install -y nginx
```

We also recommend deploying an additional VM running stock Linux. This
will be handy for demonstrating access controls to and from network
groups.
