

# ipaddress/info.php

---
- name: install apache2 and httpd
  become: yes
  hosts: all
  tasks:
   - name: install apache2 and httpd
     ansible.builtin.package:
      name: "{{ package_name }}"
      state: present
     notify: 
      - enabled and restarted package
      - update package 
     when: ansible_facts['os_family'] == "Debian" or ansible_facts['os_family'] == "RedHat"
   - name: install php modules
     ansible.builtin.package:
      name: "{{ item }}"
      state: present
     loop: "{{ php_modules }}"
     notify: 
      - enabled and restarted package
      - update package 
     when: ansible_facts['os_family'] == "Debian" or ansible_facts['os_family'] == "RedHat"
   - name: copy info.php
     ansible.builtin.copy:
      src: info.php
      dest: /var/www/html/info.php
  handlers: 
   - name: enabled and restarted package
     ansible.builtin.systemd:
      name: "{{ package_name }}"
      enabled: yes
      system: restarted  
     when: ansible_facts['os_family'] == "Debian" or ansible_facts['os_family'] == "RedHat"
   - name: update package 
     ansible.builtin.apt:
      name: "{{ package_name }}" 
      update_cache: yes
     when: ansible_facts['os_family'] == "Debian" or ansible_facts['os_family'] == "RedHat"