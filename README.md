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

Please refer to these guides for setting up the two applications:

- [3-Tier HR application based on IceHrm](3-tier-app)
- [A simple web application](simple-web-app)

