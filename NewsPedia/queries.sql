select * from tblcomments;
select * from tblusers;
select * from tblposts;
select * from tblcategory;
DESC tblcomments;
select * from tblsubcategory;

ALTER TABLE tblusers ADD COLUMN password VARCHAR(255) NOT NULL;

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`) VALUES
(7, 'Jasprit Bumrah ruled out of England T20I series due to injury', 3, 4, '<p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">The Indian Cricket Team has received a huge blow right ahead of the commencement of the much-awaited series against England. Star speedster Jasprit Bumrah has been ruled out of the forthcoming 3-match T20I series as he suffered an injury in his left thumb.</span></p><p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">The 24-year-old pacer picked up a niggle during India’s first T20I match against Ireland played on June 27 at the Malahide cricket ground in Dublin. As per the reports, he is likely to be available for the ODI series against England scheduled to start from July 12.</p><p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">In the first, Bumrah exhibited a phenomenal performance with the ball. In his quota of four overs, he conceded 19 runs and picked 2 wickets at an economy rate of 4.75.</p><p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">Post his injury, he arrived at team’s optional training session on Thursday but didn’t train. Later, he was rested in the second face-off along with MS Dhoni, Shikhar Dhawan and Bhuvneshwar Kumar.</p><p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">As of now, no replacement has been announced. However, Umesh Yadav may be be given chance in the team in Bumrah’s absence.</p><p style=\"padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">The first T20I match between India and England will be played at Old Trafford, Manchester on July 3.</p>', '2024-01-15 18:30:00', '2024-01-31 05:47:37', 1, 'Jasprit-Bumrah-ruled-out-of-England-T20I-series-due-to-injury', '6d08a26c92cf30db69197a1fb7230626.jpg', 24, 'admin', NULL),

update tblposts
set PostDetails="Tata Steel, Thyssenkrupp Finalise Landmark Steel Deal Tata Steel, Thyssenkrupp Finalise Landmark Steel DealTata Steel, Thyssenkrupp Finalise Landmark Steel DealTata Steel, Thyssenkrupp Finalise Landmark Steel DealTata Steel, Thyssenkrupp Finalise Landmark Steel Deal"
where id=10;

update tblposts
SET viewCounter=1000
where id=26;

UPDATE tblposts
SET PostImage= CASE 
    WHEN id = 31 THEN "e2.jpg"
     WHEN id = 32 THEN "e3.jpg"
    WHEN id = 33 THEN "e4.png"
    WHEN id = 34 THEN "e5.jpg"
    WHEN id = 35 THEN "e6.jpg"
	WHEN id = 36 THEN "e1.jpg"
	WHEN id = 37 THEN "e7.jpg"
	WHEN id = 38 THEN "e8.jpg"
END
WHERE id IN (31,32,33,34,35,36,37,38);

UPDATE tblposts
SET PostImage= CASE 
    WHEN id = 35 THEN "laser-light-show-with-people-dancing-at-night-in-the-middle-of-a-desert-music--SBV-347569638-preview.mp4"
     WHEN id = 44 THEN "doctor-explaining-x-ray-results-to-patient-during-hospital-visit-SBV-347292618-preview.mp4"
    WHEN id = 50 THEN "baseball-stadium-club-seat-fans-SBV-335761284-preview.mp4"
END
WHERE id IN (35,44,50);


UPDATE tblposts
set PostImage="h2.jpg"
where id=30;

select * from tblcategory;




"baseball-stadium-club-seat-fans-SBV-335761284-preview.mp4"
"doctor-explaining-x-ray-results-to-patient-during-hospital-visit-SBV-347292618-preview.mp4"
"laser-light-show-with-people-dancing-at-night-in-the-middle-of-a-desert-music--SBV-347569638-preview.mp4"