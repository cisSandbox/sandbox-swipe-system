#!/usr/bin/python

import urllib2
from bs4 import BeautifulSoup


class Course(object):
    def __init__self(self, crn, courseID, meetingID, professor, semesterID):
        self.crn = crn
        self.courseID = courseID
        self.meetingID = meetingID
        self.professor = professor
        self.semesterID = semesterID

    def generateInsertStatements(self):
        # INSERT INTO `sb-swipe`.`class` (`CRN`, `meetingID`, `courseID`, `semesterID`, `professor`) VALUES ('10058', '20', 'CS460', 's2013', 'Wong');
        return "INSERT INTO sb-swipe.class (CRN, meetingID, courseID, semesterID, professor) VALUES (\'" + self.crn + "\', \'" + self.meetingID + "\', \'" + self.courseID + "\', \'s2013\', \'" + self.professor + "\');\n"


def getMeetingID(days, times):
    blocksTimes = [
        ["2", "TR 08:30"],
        ["3", "WF 08:30"],
        ["4", "TR 09:55"],
        ["5", "WF 09:55"],
        ["6", "M 09:55"],
        ["7", "MW 11:20"],
        ["8", "TF 11:20"],
        ["9", "MR 12:45"],
        ["10", "TF 12:45"],
        ["11", "WF 02:10"],
        ["12", "TR 02:10"],
        ["13", "MW 03:35"],
        ["14", "TR 03:35"],
        ["15", "MW 05:00"],
        ["16", "TR 05:00"],
        ["20", "M 06:30"],
        ["21", "T 06:30"],
        ["22", "W 06:30"],
        ["23", "R 06:30"],
    ]
    dTime = days + " " + times[:5]
    for blockTime in blocksTimes:
        if dTime == blockTime[1]:
            return blockTime[0]


def writeToFile(statements):
    f = open('insert_statements.txt', 'w+')
    for statement in statements:
        f.write(statement)


def main():
    url = "https://my.bentley.edu/web/guest/course-listings/-/courses/201301/UC/D/CS"
    response = urllib2.urlopen(url)
    html = BeautifulSoup(response.read(), "lxml")
    output = list()
    for tr in html.find_all("tr", class_="results-row"):
        course = Course()
        if tr.select(".coursetable-crn")[0].string is not None:
            course.crn = tr.select(".coursetable-crn")[0].string
            course.professor = tr.select(".coursetable-instructor")[0].string
            course.courseID = tr.select(".coursetable-course")[0].string.replace(" ", "")[:5]
            course.semesterID = "s2013"
            course.meetingID = getMeetingID(tr.select(".coursetable-days")[0].string, tr.select(".coursetable-begintime")[0].string)
            output.append(course.generateInsertStatements())
            writeToFile(output)

if __name__ == '__main__':
    main()
