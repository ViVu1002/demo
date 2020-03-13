- viết sql:
+ tạo một sinh viên thuộc khoa B có điểm tất cả các môn học = 5 và tuổi = 50;
SELECT * FROM `persons` AS Ps INNER JOIN `points` AS Poi WHERE Ps.id = Poi.person_id AND YEAR(NOW()) - YEAR(Ps.date) >=50

+ cập nhật sinh viên có điểm trung bình thấp nhất thành 10;
SELECT ps.name, AVG(poi.point), COUNT(poi.subject_id) FROM `persons` AS ps , `points` AS poi WHERE poi.person_id = ps.id
GROUP BY poi.person_id HAVING COUNT(poi.subject_id) =10 ORDER BY AVG(poi.point) ASC LIMIT 1

+ xóa tất cả thông tin của sinh viên tuổi >= 30; (students + users)
DELETE `persons` , `users` FROM `persons` INNER JOIN `users` WHERE persons.email = users.email AND YEAR(NOW()) - YEAR(persons.date) >=30

+ tìm các sinh viên thuộc khoa A và có điểm trung bình > 5;
SELECT ps.name,ROUND(AVG(poi.point)), COUNT(poi.subject_id)
FROM `points` AS poi,`persons` AS ps
WHERE ps.id = poi.person_id
GROUP BY poi.person_id, ps.name
HAVING COUNT(poi.subject_id) = 10 AND ROUND(AVG(poi.point)) < 5

+ tìm các sinh viên có SDT viettel + có tuổi từ 18 -> 25 và có điểm thi > 5;

SELECT ps.name , ROUND(AVG(poi.point)), COUNT(poi.subject_id)
FROM `persons` AS ps,`points` AS poi
WHERE ps.id = poi.subject_id AND ps.phone LIKE '0%' AND  YEAR(NOW()) - YEAR(ps.date) >18 AND YEAR(NOW()) - YEAR(ps.date) < 40
GROUP BY poi.person_id , ps.name
HAVING COUNT(poi.subject_id) = 10 and  ROUND(AVG(poi.point)) <5

+ Giả sử A chưa học hết các môn, tìm các môn này
SELECT ps.name , COUNT(poi.person_id), sub.name
FROM `persons` AS ps,`points` AS poi,`subjects` AS sub WHERE ps.id = poi.person_id AND sub.id = poi.subject_id
GROUP BY person_id, sub.name HAVING COUNT(poi.subject_id) <10