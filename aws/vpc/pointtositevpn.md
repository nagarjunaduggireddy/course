
# point to signt VPN connection
-------------------------------


# create vpc - subnet - natgaeway -route table - security group - ec2 instance 

# connect instance and do following steps to create client and server certificates:

# Clone Easy RSA Git Repo
git clone https://github.com/OpenVPN/easy-rsa.git

cd easy-rsa/easyrsa3

# Initialize Public Key Infrastructure (PKI)
./easyrsa init-pki

# Build Certificate Authority
./easyrsa build-ca nopass

# Build Server Certificate
./easyrsa build-server-full clientvpndemo.com nopass

# Build Client Certificate
./easyrsa build-client-full pdomala.clientvpndemo.com nopass

mkdir acm

cp pki/ca.crt acm
cp pki/issued/clientvpndemo.com.crt acm
cp pki/issued/pdomala.clientvpndemo.com.crt acm
cp pki/private/clientvpndemo.com.key acm
cp pki/private/pdomala.clientvpndemo.com.key acm
# cd acm and check it

# aws configure ( Provide access key and secret key) with in created instance and import the certificate to acm.

aws acm import-certificate --certificate fileb://clientvpndemo.com.crt --private-key fileb://clientvpndemo.com.key --certificate-chain fileb://ca.crt --region ap-south-1

aws acm import-certificate --certificate fileb://pdomala.clientvpndemo.com.crt --private-key fileb://pdomala.clientvpndemo.com.key --certificate-chain fileb://ca.crt --region ap-south-1

# go to "Client VPN Endpoints" - "create VPN endpoints" - assign certificates(server and client) - create cidr range - subnets association - security groups - route tables 

# Download the certificate document - open the file - copy the server & client certifiates 

# download aws vpn client - file - manage profile - upload the saved file and try to connect

