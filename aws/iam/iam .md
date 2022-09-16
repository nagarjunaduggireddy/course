# create-group
aws iam create-group `
    --group-name "mygroup" `
    --region "ap-south-1"
"GroupId": "AGPATYFJDYERRZ56VMK7G"

# create-users
aws iam create-user `
    --user-name "myuser1" `
    --region "ap-south-1"
 "UserId": "AIDATYFJDYERSMEEYWXGK"
 arn:aws:iam::258052702499:user/myuser1

 aws iam create-user `
    --user-name "myuser2" `
    --user-name myuser1

# create policies for myuser2
aws iam create-policy `
    --policy-name "arjun-networkpolicy" `
    --region "ap-south-1" `
    --policy-document "file://network.json"
"PolicyId": "ANPATYFJDYERSUZLXWFWQ"
"Arn": "arn:aws:iam::258052702499:policy/arjun-networkpolicy"

# Attach Policy to myuser2
aws iam attach-user-policy `
    --policy-arn "arn:aws:iam::258052702499:policy/arjun-networkpolicy" `
    --user-name myuser2
aws iam create-policy `
    --policy-name "arjun-network1policy" `
    --region "ap-south-1" `
    --policy-document "file://vpc.json"
"PolicyId": "ANPATYFJDYERRUPURJCTM",
 "Arn": "arn:aws:iam::258052702499:policy/arjun-network1policy"

# create policies for myuser3
aws iam create-policy `
    --policy-name "arjun-networkreader-policy" `
    --region "ap-south-1" `
    --policy-document "file://networkreader.json"
"PolicyId": "ANPATYFJDYERTZ7LZFTKK",
"Arn": "arn:aws:iam::258052702499:policy/arjun-networkreader-policy"

"Arn": 
# Attach Policy to myuser3
aws iam attach-user-policy `
    --policy-arn "arn:aws:iam::258052702499:policy/arjun-networkreader-policy" `
    --user-name myuser3

aws iam attach-user-policy `
    --policy-arn "arn:aws:iam::258052702499:policy/arjun-network1policy" `
    --user-name myuser2

aws iam create-policy `
    --policy-name "policy4" `
    --policy-document "file://ec2-s3-rds.json"
"PolicyId": "ANPATYFJDYERYAUNX7IN3",
"Arn": "arn:aws:iam::258052702499:policy/policy4",

aws iam attach-user-policy `
    --policy-arn "arn:aws:iam::258052702499:policy/policy4" `
    --user-name myuser1
    --region "ap-south-1"
"UserId": "AIDATYFJDYERS6MWOR5FZ"
arn:aws:iam::258052702499:user/myuser2

aws iam create-user `
    --user-name "myuser3" `
    --region "ap-south-1"
UserId": "AIDATYFJDYERRDJJOUI3S"
arn:aws:iam::258052702499:user/myuser2

#  create access key for myuser1
aws iam create-access-key `
    --user-name "myuser1" `
    --region "ap-south-1"
    "AccessKeyId": "AKIATYFJDYERQFUTB7VR",
    "SecretAccessKey": "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"
# create passwd to myuser1 
aws iam create-login-profile `
    --user-name "myuser1" `
    --region "ap-south-1" `
    --password "Mouni@777" `
    --no-password-reset-required

# create passwd to myuser2
aws iam create-login-profile `
    --user-name "myuser2" `
    --region "ap-south-1" `
    --password "Mouni@777" `
    --no-password-reset-required
# create passwd to myuser3
aws iam create-login-profile `
    --user-name "myuser3" `
    --region "ap-south-1" `
    --password "Mouni@777" `
    --no-password-reset-required


# add-users-to-group
aws iam add-user-to-group `
    --group-name "mygroup" `
    --user-name "myuser1" `
    --region "ap-south-1"

aws iam add-user-to-group `
    --group-name "mygroup" `
    --user-name "myuser2" `
    --region "ap-south-1"

aws iam add-user-to-group `
    --group-name "mygroup" `
    --user-name "myuser3" `
    --region "ap-south-1"

# create policies 
aws iam create-policy `
    --policy-name "arjun-adminpolicy" `
    --region "ap-south-1" `
    --policy-document "file://admin.json"
"Arn": "arn:aws:iam::258052702499:policy/arjun-adminpolicy"

# Attach Policy to myuser1 myuser2 myuser3
aws iam attach-user-policy `
    --policy-arn "arn:aws:iam::258052702499:policy/arjun-adminpolicy" `
    --user-name "myuser1"

aws iam attach-user-policy `
    --policy-arn "arn:aws:iam::258052702499:policy/arjun-adminpolicy" `
    --user-name "myuser2"
aws iam attach-user-policy `
    --policy-arn "arn:aws:iam::258052702499:policy/arjun-adminpolicy" `
    --user-name "myuser3"

aws iam create-policy `
    --policy-name "testpolicy" `
    --region "ap-south-1" `
    --policy-document "file://admin.json"

aws iam delete-user `
--user-name "myuser2"
