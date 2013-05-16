SELECT student.firstName, tutor_ability.courseID, tutor.imgPath
FROM tutor
INNER JOIN tutor_ability ON tutor.tutorID = tutor_ability.tutorID
INNER JOIN student ON student.studentID = tutor.studentID
INNER JOIN work_visit ON work_visit.tutorID = tutor.tutorID
WHERE UNIX_TIMESTAMP(work_visit.endTime) = 0;
