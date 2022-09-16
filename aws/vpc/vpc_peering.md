# create vpc
aws ec2 create-vpc `
    --cidr-block "10.0.0.0/16" `
    --tag-specification "ResourceType=vpc,Tags=[{Key=Name,Value=MyVpc}]" `
    --region "ap-south-1"  
"vpc-043d03b17c29711dd"

# create public subnet
aws ec2 create-subnet `
    --vpc-id "vpc-043d03b17c29711dd" `
    --cidr-block "10.0.0.0/24" ` 
    --tag-specifications "ResourceType=subnet,Tags=[{Key=Name,Value=my-ipv4-only-pubsubnet}]" `
    --region "ap-south-1a"  
    "subnet-04b1d89bc3f40fbb8"

# create-internet-gateway
aws ec2 create-internet-gateway `
    --region "ap-south-1"
    "igw-0953b541f3fbcf7c8"

# attach-internet-gateway
aws ec2 attach-internet-gateway `
    --internet-gateway-id "igw-0953b541f3fbcf7c8" `
    --vpc-id "vpc-043d03b17c29711dd"

# create private subnet
aws ec2 create-subnet `
    --vpc-id "vpc-043d03b17c29711dd" `
    --cidr-block "10.0.1.0/24" ` 
    --tag-specifications "ResourceType=subnet,Tags=[{Key=Name,Value=my-ipv4-only-prisubnet}]" `
    --region "ap-south-1b" 
    "subnet-0298f809e32687cbc"

# create public route-table
aws ec2 create-route-table `
    --vpc-id "vpc-043d03b17c29711dd" `
    --tag-specifications "ResourceType=route-table,Tags=[{Key=Name,Value=pub-route}]" `
    --region "ap-south-1"
    "rtb-06c461241be3f6f94"

# create private route-table
aws ec2 create-route-table `
    --vpc-id "vpc-043d03b17c29711dd" `
    --tag-specifications "ResourceType=route-table,Tags=[{Key=Name,Value=pri-route}]" `
    --region "ap-south-1"  
    "rtb-0ef8d2596ebfe8010"

# create public route
aws ec2 create-route `
    --route-table-id "rtb-06c461241be3f6f94" `
    --destination-cidr-block "0.0.0.0/0" `
    --gateway-id "igw-0953b541f3fbcf7c8"

# create private route
aws ec2 create-route `
    --route-table-id "rtb-0ef8d2596ebfe8010" `
    --destination-cidr-block "0.0.0.0/0" `
    --gateway-id "igw-0953b541f3fbcf7c8"


# associate-public-route-table
aws ec2 associate-route-table `
    --route-table-id "rtb-06c461241be3f6f94" `
    --subnet-id "subnet-04b1d89bc3f40fbb8"
     "rtbassoc-01d6f83fb50d7014f"

# associate-private-route-table
aws ec2 associate-route-table `
    --route-table-id "rtb-0ef8d2596ebfe8010" `
    --subnet-id "subnet-0298f809e32687cbc"
    "rtbassoc-011871affdd806374"

# create-public-security-group
aws ec2 create-security-group `
    --group-name "south-secgrp" `
    --description "My security group" `
    --vpc-id "vpc-043d03b17c29711dd" `
    --tag-specifications "ResourceType=security-group,Tags=[{Key=Name,Value=south-secgrp}]" `
    --region "ap-south-1"
    "sg-08cb66d0418ab8690"

# create-private-security-group
aws ec2 create-security-group `
    --group-name "south-secgrp-private" `
    --description "My private security group" `
    --vpc-id "vpc-043d03b17c29711dd" `
    --tag-specifications "ResourceType=security-group,Tags=[{Key=Name,Value=south-secgrp-private}]" `
    --region "ap-south-1"
     "sg-0f0b6354ebe701720"

# authorize-public-security-group-ingress
aws ec2 authorize-security-group-ingress `
    --group-id "sg-08cb66d0418ab8690" `
    --protocol "tcp" `
    --port "22" `
    --cidr "0.0.0.0/0"
"SecurityGroupRuleId": "sgr-0173749fda72b2109"

# authorize-public-security-group-ingress
aws ec2 authorize-security-group-ingress `
    --group-id "sg-08cb66d0418ab8690" `
    --protocol "tcp" `
    --port "80" `
    --cidr "0.0.0.0/0"
"SecurityGroupRuleId": "sgr-06e4bf890f0adeb53"

# authorize-public-security-group-ingress
aws ec2 authorize-security-group-ingress `
    --group-id "sg-08cb66d0418ab8690" `
    --protocol "tcp" `
    --port "443" `
    --cidr "0.0.0.0/0"
 "SecurityGroupRuleId": "sgr-019cca1fc40297c44"

 
# authorize-private-security-group-ingress
aws ec2 authorize-security-group-ingress `
    --group-id "sg-0f0b6354ebe701720" `
    --protocol "all" `
    --port 0-65535 `
    --cidr "10.0.0.0/16"
"SecurityGroupRuleId": "sgr-0c3dda820833bc252"

# create-network-acl
aws ec2 create-network-acl `
    --vpc-id "vpc-043d03b17c29711dd" `
    --tag-specifications "ResourceType=network-acl,Tags=[{Key=Name,Value=pub-network-acl}]" `
"NetworkAclId": "acl-06f74c4f1ba2a351c"


# create-network-acl-entry 
aws ec2 create-network-acl-entry `
    --network-acl-id "acl-06f74c4f1ba2a351c" `
    --ingress `
    --rule-number 200 `
    --protocol "tcp" `
    --port-range From=22,To=22 `
    --cidr-block "0.0.0.0/0" `
    --rule-action "allow"

# create-network-acl-entry 
aws ec2 create-network-acl-entry `
    --network-acl-id "acl-06f74c4f1ba2a351c" `
    --ingress `
    --rule-number 210 `
    --protocol "tcp" `
    --port-range From=80,To=80 `
    --cidr-block "0.0.0.0/0" `
    --rule-action "allow"

# create-network-acl-entry 
aws ec2 create-network-acl-entry `
    --network-acl-id "acl-06f74c4f1ba2a351c" `
    --ingress `
    --rule-number 220 `
    --protocol "tcp" `
    --port-range From=443,To=443 `
    --cidr-block "0.0.0.0/0" `
    --rule-action "allow"

# create-network-acl-entry
aws ec2 create-network-acl-entry `
    --network-acl-id "acl-06f74c4f1ba2a351c" `
    --ingress `
    --rule-number 230 `
    --protocol "all" `
    --port-range From=0,To=65535 `
    --cidr-block "0.0.0.0/0" `
    --rule-action "allow"

# 
aws ec2 create-key-pair 
--key-name MyKeyPair

# create ec2 instance for public subnet
aws ec2 run-instances `
    --region "ap-south-1" `
    --image-id "ami-006d3995d3a6b963b" `
    --security-group-ids "sg-08cb66d0418ab8690" `
    --subnet-id "subnet-04b1d89bc3f40fbb8" `
    --instance-type "t2.micro" `
    --tag-specifications "ResourceType=instance,Tags=[{Key=Name,Value=pub-instance}]" `
    --key-name "testkey" `
    --associate-public-ip-address
"InstanceId": "i-03d9a456f5d6110cd"

# create ec2 instance for private subnet
aws ec2 run-instances `
    --region "ap-south-1" `
    --image-id "ami-006d3995d3a6b963b" `
    --security-group-ids "sg-0f0b6354ebe701720" `
    --subnet-id "subnet-0298f809e32687cbc" `
    --instance-type "t2.micro" `
    --tag-specifications "ResourceType=instance,Tags=[{Key=Name,Value=pri-instance}]" `
    --key-name "testkey"
 "InstanceId": "i-0497bf4910f9e27a2"

 # create ec2 instance with imported key for public subnet
aws ec2 run-instances `
    --region "ap-south-1" `
    --image-id "ami-006d3995d3a6b963b" `
    --security-group-ids "sg-08cb66d0418ab8690" `
    --subnet-id "subnet-04b1d89bc3f40fbb8" `
    --instance-type "t2.micro" `
    --tag-specifications "ResourceType=instance,Tags=[{Key=Name,Value=test-instance}]" `
    --key-name "mykey" `
    --associate-public-ip-address
"InstanceId": "i-00f9334008040d873"

# create ec2 instance  with imported key for private subnet
aws ec2 run-instances `
    --region "ap-south-1" `
    --image-id "ami-006d3995d3a6b963b" `
    --security-group-ids "sg-0f0b6354ebe701720" `
    --subnet-id "subnet-0298f809e32687cbc" `
    --instance-type "t2.micro" `
    --tag-specifications "ResourceType=instance,Tags=[{Key=Name,Value=pri-instance}]" `
    --key-name "mykey"
"i-081b711d7687131c4"

# create elastic ip adress 
aws ec2 allocate-address `
    --region "ap-south-1"
"AllocationId": "eipalloc-07465ccd65a08297f"

# create-nat-gateway
aws ec2 create-nat-gateway `
    --subnet-id "subnet-04b1d89bc3f40fbb8" `
    --allocation-id "eipalloc-07465ccd65a08297f" `
    --region "ap-south-1"
"NatGatewayId": "nat-073df97fd954d6b8d"


# replace-route to attach nat gateway
aws ec2 replace-route `
    --route-table-id "rtb-0ef8d2596ebfe8010" `
    --destination-cidr-block "0.0.0.0/0" `
    --gateway-id "nat-073df97fd954d6b8d" `
    --region "ap-south-1"

# delete-nat-gateway
aws ec2 delete-nat-gateway `
    --nat-gateway-id "nat-073df97fd954d6b8d" 

# release-elastic-ip-address
aws ec2 release-address `
    --allocation-id "eipalloc-07465ccd65a08297f" 

# copy private key and change file permission to readonly from public instance and connect to private instance