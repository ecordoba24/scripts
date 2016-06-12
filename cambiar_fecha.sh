#!/bin/bash

function isDateInvalid()
{
  date -d "$1" "+%m/%d/%Y" > /dev/null 2>&1
  res=$?
  echo "$res"
}

for year in {2016..2020..1}
do
	for month in {01..12..1}
	do
		for day in {01..31..1}
 		do
			fecha1="$year-$month-$day"
			num=$(isDateInvalid "$fecha1")
			if [ $num = 0 ]; then
				echo "$fecha1 15:00:00"
				timedatectl set-time "$fecha1 15:00:00"
				read -p "Press [Enter]"
			fi
		done
		echo ""
	done
	echo ""
done
