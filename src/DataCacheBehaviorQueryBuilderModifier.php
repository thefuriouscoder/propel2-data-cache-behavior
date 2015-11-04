<?php

namespace Base;

use \Place as ChildPlace;
use \PlaceQuery as ChildPlaceQuery;
use \Exception;
use \PDO;
use Map\PlaceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'public.place' table.
 *
 * Old table: locales
 *
 * @method     ChildPlaceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPlaceQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPlaceQuery orderByTagline($order = Criteria::ASC) Order by the tagline column
 * @method     ChildPlaceQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildPlaceQuery orderByRoadtypeId($order = Criteria::ASC) Order by the roadtype_id column
 * @method     ChildPlaceQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildPlaceQuery orderByCityId($order = Criteria::ASC) Order by the city_id column
 * @method     ChildPlaceQuery orderByZipcode($order = Criteria::ASC) Order by the zipcode column
 * @method     ChildPlaceQuery orderByProvinceId($order = Criteria::ASC) Order by the province_id column
 * @method     ChildPlaceQuery orderByCountryId($order = Criteria::ASC) Order by the country_id column
 * @method     ChildPlaceQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 * @method     ChildPlaceQuery orderByLongitude($order = Criteria::ASC) Order by the longitude column
 * @method     ChildPlaceQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildPlaceQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildPlaceQuery orderByWebsite($order = Criteria::ASC) Order by the website column
 * @method     ChildPlaceQuery orderByFacebook($order = Criteria::ASC) Order by the facebook column
 * @method     ChildPlaceQuery orderByRrss($order = Criteria::ASC) Order by the rrss column
 * @method     ChildPlaceQuery orderByBasicFeatures($order = Criteria::ASC) Order by the basic_features column
 * @method     ChildPlaceQuery orderByOpeningHours($order = Criteria::ASC) Order by the opening_hours column
 * @method     ChildPlaceQuery orderByUserQuestions($order = Criteria::ASC) Order by the user_questions column
 * @method     ChildPlaceQuery orderByConfiguration($order = Criteria::ASC) Order by the configuration column
 * @method     ChildPlaceQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildPlaceQuery orderBySubscriptionId($order = Criteria::ASC) Order by the subscription_id column
 * @method     ChildPlaceQuery orderByStatusId($order = Criteria::ASC) Order by the status_id column
 * @method     ChildPlaceQuery orderByIsAffiliate($order = Criteria::ASC) Order by the is_affiliate column
 * @method     ChildPlaceQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method     ChildPlaceQuery orderByManagedBy($order = Criteria::ASC) Order by the managed_by column
 * @method     ChildPlaceQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     ChildPlaceQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPlaceQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildPlaceQuery orderByTotalSubscribers($order = Criteria::ASC) Order by the total_subscribers column
 * @method     ChildPlaceQuery orderByTotalFavorites($order = Criteria::ASC) Order by the total_favorites column
 * @method     ChildPlaceQuery orderByTotalDiary($order = Criteria::ASC) Order by the total_diary column
 * @method     ChildPlaceQuery orderByVipSubscribers($order = Criteria::ASC) Order by the vip_subscribers column
 * @method     ChildPlaceQuery orderByLastSubscriber($order = Criteria::ASC) Order by the last_subscriber column
 *
 * @method     ChildPlaceQuery groupById() Group by the id column
 * @method     ChildPlaceQuery groupByName() Group by the name column
 * @method     ChildPlaceQuery groupByTagline() Group by the tagline column
 * @method     ChildPlaceQuery groupByDescription() Group by the description column
 * @method     ChildPlaceQuery groupByRoadtypeId() Group by the roadtype_id column
 * @method     ChildPlaceQuery groupByAddress() Group by the address column
 * @method     ChildPlaceQuery groupByCityId() Group by the city_id column
 * @method     ChildPlaceQuery groupByZipcode() Group by the zipcode column
 * @method     ChildPlaceQuery groupByProvinceId() Group by the province_id column
 * @method     ChildPlaceQuery groupByCountryId() Group by the country_id column
 * @method     ChildPlaceQuery groupByLatitude() Group by the latitude column
 * @method     ChildPlaceQuery groupByLongitude() Group by the longitude column
 * @method     ChildPlaceQuery groupByPhone() Group by the phone column
 * @method     ChildPlaceQuery groupByEmail() Group by the email column
 * @method     ChildPlaceQuery groupByWebsite() Group by the website column
 * @method     ChildPlaceQuery groupByFacebook() Group by the facebook column
 * @method     ChildPlaceQuery groupByRrss() Group by the rrss column
 * @method     ChildPlaceQuery groupByBasicFeatures() Group by the basic_features column
 * @method     ChildPlaceQuery groupByOpeningHours() Group by the opening_hours column
 * @method     ChildPlaceQuery groupByUserQuestions() Group by the user_questions column
 * @method     ChildPlaceQuery groupByConfiguration() Group by the configuration column
 * @method     ChildPlaceQuery groupByCompanyId() Group by the company_id column
 * @method     ChildPlaceQuery groupBySubscriptionId() Group by the subscription_id column
 * @method     ChildPlaceQuery groupByStatusId() Group by the status_id column
 * @method     ChildPlaceQuery groupByIsAffiliate() Group by the is_affiliate column
 * @method     ChildPlaceQuery groupByCreatedBy() Group by the created_by column
 * @method     ChildPlaceQuery groupByManagedBy() Group by the managed_by column
 * @method     ChildPlaceQuery groupBySlug() Group by the slug column
 * @method     ChildPlaceQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPlaceQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildPlaceQuery groupByTotalSubscribers() Group by the total_subscribers column
 * @method     ChildPlaceQuery groupByTotalFavorites() Group by the total_favorites column
 * @method     ChildPlaceQuery groupByTotalDiary() Group by the total_diary column
 * @method     ChildPlaceQuery groupByVipSubscribers() Group by the vip_subscribers column
 * @method     ChildPlaceQuery groupByLastSubscriber() Group by the last_subscriber column
 *
 * @method     ChildPlaceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPlaceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPlaceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPlaceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPlaceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPlaceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPlaceQuery leftJoinRoadType($relationAlias = null) Adds a LEFT JOIN clause to the query using the RoadType relation
 * @method     ChildPlaceQuery rightJoinRoadType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RoadType relation
 * @method     ChildPlaceQuery innerJoinRoadType($relationAlias = null) Adds a INNER JOIN clause to the query using the RoadType relation
 *
 * @method     ChildPlaceQuery joinWithRoadType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RoadType relation
 *
 * @method     ChildPlaceQuery leftJoinWithRoadType() Adds a LEFT JOIN clause and with to the query using the RoadType relation
 * @method     ChildPlaceQuery rightJoinWithRoadType() Adds a RIGHT JOIN clause and with to the query using the RoadType relation
 * @method     ChildPlaceQuery innerJoinWithRoadType() Adds a INNER JOIN clause and with to the query using the RoadType relation
 *
 * @method     ChildPlaceQuery leftJoinCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the City relation
 * @method     ChildPlaceQuery rightJoinCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the City relation
 * @method     ChildPlaceQuery innerJoinCity($relationAlias = null) Adds a INNER JOIN clause to the query using the City relation
 *
 * @method     ChildPlaceQuery joinWithCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the City relation
 *
 * @method     ChildPlaceQuery leftJoinWithCity() Adds a LEFT JOIN clause and with to the query using the City relation
 * @method     ChildPlaceQuery rightJoinWithCity() Adds a RIGHT JOIN clause and with to the query using the City relation
 * @method     ChildPlaceQuery innerJoinWithCity() Adds a INNER JOIN clause and with to the query using the City relation
 *
 * @method     ChildPlaceQuery leftJoinProvince($relationAlias = null) Adds a LEFT JOIN clause to the query using the Province relation
 * @method     ChildPlaceQuery rightJoinProvince($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Province relation
 * @method     ChildPlaceQuery innerJoinProvince($relationAlias = null) Adds a INNER JOIN clause to the query using the Province relation
 *
 * @method     ChildPlaceQuery joinWithProvince($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Province relation
 *
 * @method     ChildPlaceQuery leftJoinWithProvince() Adds a LEFT JOIN clause and with to the query using the Province relation
 * @method     ChildPlaceQuery rightJoinWithProvince() Adds a RIGHT JOIN clause and with to the query using the Province relation
 * @method     ChildPlaceQuery innerJoinWithProvince() Adds a INNER JOIN clause and with to the query using the Province relation
 *
 * @method     ChildPlaceQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     ChildPlaceQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     ChildPlaceQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     ChildPlaceQuery joinWithCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Country relation
 *
 * @method     ChildPlaceQuery leftJoinWithCountry() Adds a LEFT JOIN clause and with to the query using the Country relation
 * @method     ChildPlaceQuery rightJoinWithCountry() Adds a RIGHT JOIN clause and with to the query using the Country relation
 * @method     ChildPlaceQuery innerJoinWithCountry() Adds a INNER JOIN clause and with to the query using the Country relation
 *
 * @method     ChildPlaceQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildPlaceQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildPlaceQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildPlaceQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildPlaceQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildPlaceQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildPlaceQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildPlaceQuery leftJoinSubscription($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subscription relation
 * @method     ChildPlaceQuery rightJoinSubscription($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subscription relation
 * @method     ChildPlaceQuery innerJoinSubscription($relationAlias = null) Adds a INNER JOIN clause to the query using the Subscription relation
 *
 * @method     ChildPlaceQuery joinWithSubscription($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Subscription relation
 *
 * @method     ChildPlaceQuery leftJoinWithSubscription() Adds a LEFT JOIN clause and with to the query using the Subscription relation
 * @method     ChildPlaceQuery rightJoinWithSubscription() Adds a RIGHT JOIN clause and with to the query using the Subscription relation
 * @method     ChildPlaceQuery innerJoinWithSubscription() Adds a INNER JOIN clause and with to the query using the Subscription relation
 *
 * @method     ChildPlaceQuery leftJoinStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the Status relation
 * @method     ChildPlaceQuery rightJoinStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Status relation
 * @method     ChildPlaceQuery innerJoinStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the Status relation
 *
 * @method     ChildPlaceQuery joinWithStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Status relation
 *
 * @method     ChildPlaceQuery leftJoinWithStatus() Adds a LEFT JOIN clause and with to the query using the Status relation
 * @method     ChildPlaceQuery rightJoinWithStatus() Adds a RIGHT JOIN clause and with to the query using the Status relation
 * @method     ChildPlaceQuery innerJoinWithStatus() Adds a INNER JOIN clause and with to the query using the Status relation
 *
 * @method     ChildPlaceQuery leftJoinOwner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Owner relation
 * @method     ChildPlaceQuery rightJoinOwner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Owner relation
 * @method     ChildPlaceQuery innerJoinOwner($relationAlias = null) Adds a INNER JOIN clause to the query using the Owner relation
 *
 * @method     ChildPlaceQuery joinWithOwner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Owner relation
 *
 * @method     ChildPlaceQuery leftJoinWithOwner() Adds a LEFT JOIN clause and with to the query using the Owner relation
 * @method     ChildPlaceQuery rightJoinWithOwner() Adds a RIGHT JOIN clause and with to the query using the Owner relation
 * @method     ChildPlaceQuery innerJoinWithOwner() Adds a INNER JOIN clause and with to the query using the Owner relation
 *
 * @method     ChildPlaceQuery leftJoinPlacePlaceType($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlacePlaceType relation
 * @method     ChildPlaceQuery rightJoinPlacePlaceType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlacePlaceType relation
 * @method     ChildPlaceQuery innerJoinPlacePlaceType($relationAlias = null) Adds a INNER JOIN clause to the query using the PlacePlaceType relation
 *
 * @method     ChildPlaceQuery joinWithPlacePlaceType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PlacePlaceType relation
 *
 * @method     ChildPlaceQuery leftJoinWithPlacePlaceType() Adds a LEFT JOIN clause and with to the query using the PlacePlaceType relation
 * @method     ChildPlaceQuery rightJoinWithPlacePlaceType() Adds a RIGHT JOIN clause and with to the query using the PlacePlaceType relation
 * @method     ChildPlaceQuery innerJoinWithPlacePlaceType() Adds a INNER JOIN clause and with to the query using the PlacePlaceType relation
 *
 * @method     ChildPlaceQuery leftJoinPlaceLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlaceLocation relation
 * @method     ChildPlaceQuery rightJoinPlaceLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlaceLocation relation
 * @method     ChildPlaceQuery innerJoinPlaceLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the PlaceLocation relation
 *
 * @method     ChildPlaceQuery joinWithPlaceLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PlaceLocation relation
 *
 * @method     ChildPlaceQuery leftJoinWithPlaceLocation() Adds a LEFT JOIN clause and with to the query using the PlaceLocation relation
 * @method     ChildPlaceQuery rightJoinWithPlaceLocation() Adds a RIGHT JOIN clause and with to the query using the PlaceLocation relation
 * @method     ChildPlaceQuery innerJoinWithPlaceLocation() Adds a INNER JOIN clause and with to the query using the PlaceLocation relation
 *
 * @method     ChildPlaceQuery leftJoinPlaceTarget($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlaceTarget relation
 * @method     ChildPlaceQuery rightJoinPlaceTarget($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlaceTarget relation
 * @method     ChildPlaceQuery innerJoinPlaceTarget($relationAlias = null) Adds a INNER JOIN clause to the query using the PlaceTarget relation
 *
 * @method     ChildPlaceQuery joinWithPlaceTarget($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PlaceTarget relation
 *
 * @method     ChildPlaceQuery leftJoinWithPlaceTarget() Adds a LEFT JOIN clause and with to the query using the PlaceTarget relation
 * @method     ChildPlaceQuery rightJoinWithPlaceTarget() Adds a RIGHT JOIN clause and with to the query using the PlaceTarget relation
 * @method     ChildPlaceQuery innerJoinWithPlaceTarget() Adds a INNER JOIN clause and with to the query using the PlaceTarget relation
 *
 * @method     ChildPlaceQuery leftJoinPlaceFeature($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlaceFeature relation
 * @method     ChildPlaceQuery rightJoinPlaceFeature($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlaceFeature relation
 * @method     ChildPlaceQuery innerJoinPlaceFeature($relationAlias = null) Adds a INNER JOIN clause to the query using the PlaceFeature relation
 *
 * @method     ChildPlaceQuery joinWithPlaceFeature($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PlaceFeature relation
 *
 * @method     ChildPlaceQuery leftJoinWithPlaceFeature() Adds a LEFT JOIN clause and with to the query using the PlaceFeature relation
 * @method     ChildPlaceQuery rightJoinWithPlaceFeature() Adds a RIGHT JOIN clause and with to the query using the PlaceFeature relation
 * @method     ChildPlaceQuery innerJoinWithPlaceFeature() Adds a INNER JOIN clause and with to the query using the PlaceFeature relation
 *
 * @method     ChildPlaceQuery leftJoinPlaceKnowus($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlaceKnowus relation
 * @method     ChildPlaceQuery rightJoinPlaceKnowus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlaceKnowus relation
 * @method     ChildPlaceQuery innerJoinPlaceKnowus($relationAlias = null) Adds a INNER JOIN clause to the query using the PlaceKnowus relation
 *
 * @method     ChildPlaceQuery joinWithPlaceKnowus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PlaceKnowus relation
 *
 * @method     ChildPlaceQuery leftJoinWithPlaceKnowus() Adds a LEFT JOIN clause and with to the query using the PlaceKnowus relation
 * @method     ChildPlaceQuery rightJoinWithPlaceKnowus() Adds a RIGHT JOIN clause and with to the query using the PlaceKnowus relation
 * @method     ChildPlaceQuery innerJoinWithPlaceKnowus() Adds a INNER JOIN clause and with to the query using the PlaceKnowus relation
 *
 * @method     ChildPlaceQuery leftJoinDelivery($relationAlias = null) Adds a LEFT JOIN clause to the query using the Delivery relation
 * @method     ChildPlaceQuery rightJoinDelivery($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Delivery relation
 * @method     ChildPlaceQuery innerJoinDelivery($relationAlias = null) Adds a INNER JOIN clause to the query using the Delivery relation
 *
 * @method     ChildPlaceQuery joinWithDelivery($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Delivery relation
 *
 * @method     ChildPlaceQuery leftJoinWithDelivery() Adds a LEFT JOIN clause and with to the query using the Delivery relation
 * @method     ChildPlaceQuery rightJoinWithDelivery() Adds a RIGHT JOIN clause and with to the query using the Delivery relation
 * @method     ChildPlaceQuery innerJoinWithDelivery() Adds a INNER JOIN clause and with to the query using the Delivery relation
 *
 * @method     ChildPlaceQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method     ChildPlaceQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method     ChildPlaceQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method     ChildPlaceQuery joinWithEvent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Event relation
 *
 * @method     ChildPlaceQuery leftJoinWithEvent() Adds a LEFT JOIN clause and with to the query using the Event relation
 * @method     ChildPlaceQuery rightJoinWithEvent() Adds a RIGHT JOIN clause and with to the query using the Event relation
 * @method     ChildPlaceQuery innerJoinWithEvent() Adds a INNER JOIN clause and with to the query using the Event relation
 *
 * @method     ChildPlaceQuery leftJoinFoodTypePlace($relationAlias = null) Adds a LEFT JOIN clause to the query using the FoodTypePlace relation
 * @method     ChildPlaceQuery rightJoinFoodTypePlace($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FoodTypePlace relation
 * @method     ChildPlaceQuery innerJoinFoodTypePlace($relationAlias = null) Adds a INNER JOIN clause to the query using the FoodTypePlace relation
 *
 * @method     ChildPlaceQuery joinWithFoodTypePlace($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FoodTypePlace relation
 *
 * @method     ChildPlaceQuery leftJoinWithFoodTypePlace() Adds a LEFT JOIN clause and with to the query using the FoodTypePlace relation
 * @method     ChildPlaceQuery rightJoinWithFoodTypePlace() Adds a RIGHT JOIN clause and with to the query using the FoodTypePlace relation
 * @method     ChildPlaceQuery innerJoinWithFoodTypePlace() Adds a INNER JOIN clause and with to the query using the FoodTypePlace relation
 *
 * @method     ChildPlaceQuery leftJoinPicture($relationAlias = null) Adds a LEFT JOIN clause to the query using the Picture relation
 * @method     ChildPlaceQuery rightJoinPicture($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Picture relation
 * @method     ChildPlaceQuery innerJoinPicture($relationAlias = null) Adds a INNER JOIN clause to the query using the Picture relation
 *
 * @method     ChildPlaceQuery joinWithPicture($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Picture relation
 *
 * @method     ChildPlaceQuery leftJoinWithPicture() Adds a LEFT JOIN clause and with to the query using the Picture relation
 * @method     ChildPlaceQuery rightJoinWithPicture() Adds a RIGHT JOIN clause and with to the query using the Picture relation
 * @method     ChildPlaceQuery innerJoinWithPicture() Adds a INNER JOIN clause and with to the query using the Picture relation
 *
 * @method     ChildPlaceQuery leftJoinPictureFolder($relationAlias = null) Adds a LEFT JOIN clause to the query using the PictureFolder relation
 * @method     ChildPlaceQuery rightJoinPictureFolder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PictureFolder relation
 * @method     ChildPlaceQuery innerJoinPictureFolder($relationAlias = null) Adds a INNER JOIN clause to the query using the PictureFolder relation
 *
 * @method     ChildPlaceQuery joinWithPictureFolder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PictureFolder relation
 *
 * @method     ChildPlaceQuery leftJoinWithPictureFolder() Adds a LEFT JOIN clause and with to the query using the PictureFolder relation
 * @method     ChildPlaceQuery rightJoinWithPictureFolder() Adds a RIGHT JOIN clause and with to the query using the PictureFolder relation
 * @method     ChildPlaceQuery innerJoinWithPictureFolder() Adds a INNER JOIN clause and with to the query using the PictureFolder relation
 *
 * @method     ChildPlaceQuery leftJoinUnsubscription($relationAlias = null) Adds a LEFT JOIN clause to the query using the Unsubscription relation
 * @method     ChildPlaceQuery rightJoinUnsubscription($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Unsubscription relation
 * @method     ChildPlaceQuery innerJoinUnsubscription($relationAlias = null) Adds a INNER JOIN clause to the query using the Unsubscription relation
 *
 * @method     ChildPlaceQuery joinWithUnsubscription($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Unsubscription relation
 *
 * @method     ChildPlaceQuery leftJoinWithUnsubscription() Adds a LEFT JOIN clause and with to the query using the Unsubscription relation
 * @method     ChildPlaceQuery rightJoinWithUnsubscription() Adds a RIGHT JOIN clause and with to the query using the Unsubscription relation
 * @method     ChildPlaceQuery innerJoinWithUnsubscription() Adds a INNER JOIN clause and with to the query using the Unsubscription relation
 *
 * @method     ChildPlaceQuery leftJoinSubscriberPlace($relationAlias = null) Adds a LEFT JOIN clause to the query using the SubscriberPlace relation
 * @method     ChildPlaceQuery rightJoinSubscriberPlace($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SubscriberPlace relation
 * @method     ChildPlaceQuery innerJoinSubscriberPlace($relationAlias = null) Adds a INNER JOIN clause to the query using the SubscriberPlace relation
 *
 * @method     ChildPlaceQuery joinWithSubscriberPlace($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SubscriberPlace relation
 *
 * @method     ChildPlaceQuery leftJoinWithSubscriberPlace() Adds a LEFT JOIN clause and with to the query using the SubscriberPlace relation
 * @method     ChildPlaceQuery rightJoinWithSubscriberPlace() Adds a RIGHT JOIN clause and with to the query using the SubscriberPlace relation
 * @method     ChildPlaceQuery innerJoinWithSubscriberPlace() Adds a INNER JOIN clause and with to the query using the SubscriberPlace relation
 *
 * @method     \RoadTypeQuery|\CityQuery|\ProvinceQuery|\CountryQuery|\CompanyQuery|\SubscriptionQuery|\StatusQuery|\UserQuery|\PlacePlaceTypeQuery|\PlaceLocationQuery|\PlaceTargetQuery|\PlaceFeatureQuery|\PlaceKnowusQuery|\DeliveryQuery|\EventQuery|\FoodTypePlaceQuery|\PictureQuery|\PictureFolderQuery|\UnsubscriptionQuery|\SubscriberPlaceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPlace findOne(ConnectionInterface $con = null) Return the first ChildPlace matching the query
 * @method     ChildPlace findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPlace matching the query, or a new ChildPlace object populated from the query conditions when no match is found
 *
 * @method     ChildPlace findOneById(int $id) Return the first ChildPlace filtered by the id column
 * @method     ChildPlace findOneByName(string $name) Return the first ChildPlace filtered by the name column
 * @method     ChildPlace findOneByTagline(string $tagline) Return the first ChildPlace filtered by the tagline column
 * @method     ChildPlace findOneByDescription(string $description) Return the first ChildPlace filtered by the description column
 * @method     ChildPlace findOneByRoadtypeId(int $roadtype_id) Return the first ChildPlace filtered by the roadtype_id column
 * @method     ChildPlace findOneByAddress(string $address) Return the first ChildPlace filtered by the address column
 * @method     ChildPlace findOneByCityId(int $city_id) Return the first ChildPlace filtered by the city_id column
 * @method     ChildPlace findOneByZipcode(string $zipcode) Return the first ChildPlace filtered by the zipcode column
 * @method     ChildPlace findOneByProvinceId(int $province_id) Return the first ChildPlace filtered by the province_id column
 * @method     ChildPlace findOneByCountryId(int $country_id) Return the first ChildPlace filtered by the country_id column
 * @method     ChildPlace findOneByLatitude(double $latitude) Return the first ChildPlace filtered by the latitude column
 * @method     ChildPlace findOneByLongitude(double $longitude) Return the first ChildPlace filtered by the longitude column
 * @method     ChildPlace findOneByPhone(string $phone) Return the first ChildPlace filtered by the phone column
 * @method     ChildPlace findOneByEmail(string $email) Return the first ChildPlace filtered by the email column
 * @method     ChildPlace findOneByWebsite(string $website) Return the first ChildPlace filtered by the website column
 * @method     ChildPlace findOneByFacebook(string $facebook) Return the first ChildPlace filtered by the facebook column
 * @method     ChildPlace findOneByRrss(string $rrss) Return the first ChildPlace filtered by the rrss column
 * @method     ChildPlace findOneByBasicFeatures(string $basic_features) Return the first ChildPlace filtered by the basic_features column
 * @method     ChildPlace findOneByOpeningHours(string $opening_hours) Return the first ChildPlace filtered by the opening_hours column
 * @method     ChildPlace findOneByUserQuestions(string $user_questions) Return the first ChildPlace filtered by the user_questions column
 * @method     ChildPlace findOneByConfiguration(string $configuration) Return the first ChildPlace filtered by the configuration column
 * @method     ChildPlace findOneByCompanyId(int $company_id) Return the first ChildPlace filtered by the company_id column
 * @method     ChildPlace findOneBySubscriptionId(int $subscription_id) Return the first ChildPlace filtered by the subscription_id column
 * @method     ChildPlace findOneByStatusId(int $status_id) Return the first ChildPlace filtered by the status_id column
 * @method     ChildPlace findOneByIsAffiliate(boolean $is_affiliate) Return the first ChildPlace filtered by the is_affiliate column
 * @method     ChildPlace findOneByCreatedBy(int $created_by) Return the first ChildPlace filtered by the created_by column
 * @method     ChildPlace findOneByManagedBy(string $managed_by) Return the first ChildPlace filtered by the managed_by column
 * @method     ChildPlace findOneBySlug(string $slug) Return the first ChildPlace filtered by the slug column
 * @method     ChildPlace findOneByCreatedAt(string $created_at) Return the first ChildPlace filtered by the created_at column
 * @method     ChildPlace findOneByUpdatedAt(string $updated_at) Return the first ChildPlace filtered by the updated_at column
 * @method     ChildPlace findOneByTotalSubscribers(int $total_subscribers) Return the first ChildPlace filtered by the total_subscribers column
 * @method     ChildPlace findOneByTotalFavorites(int $total_favorites) Return the first ChildPlace filtered by the total_favorites column
 * @method     ChildPlace findOneByTotalDiary(int $total_diary) Return the first ChildPlace filtered by the total_diary column
 * @method     ChildPlace findOneByVipSubscribers(int $vip_subscribers) Return the first ChildPlace filtered by the vip_subscribers column
 * @method     ChildPlace findOneByLastSubscriber(int $last_subscriber) Return the first ChildPlace filtered by the last_subscriber column *

 * @method     ChildPlace requirePk($key, ConnectionInterface $con = null) Return the ChildPlace by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOne(ConnectionInterface $con = null) Return the first ChildPlace matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPlace requireOneById(int $id) Return the first ChildPlace filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByName(string $name) Return the first ChildPlace filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByTagline(string $tagline) Return the first ChildPlace filtered by the tagline column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByDescription(string $description) Return the first ChildPlace filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByRoadtypeId(int $roadtype_id) Return the first ChildPlace filtered by the roadtype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByAddress(string $address) Return the first ChildPlace filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByCityId(int $city_id) Return the first ChildPlace filtered by the city_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByZipcode(string $zipcode) Return the first ChildPlace filtered by the zipcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByProvinceId(int $province_id) Return the first ChildPlace filtered by the province_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByCountryId(int $country_id) Return the first ChildPlace filtered by the country_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByLatitude(double $latitude) Return the first ChildPlace filtered by the latitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByLongitude(double $longitude) Return the first ChildPlace filtered by the longitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByPhone(string $phone) Return the first ChildPlace filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByEmail(string $email) Return the first ChildPlace filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByWebsite(string $website) Return the first ChildPlace filtered by the website column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByFacebook(string $facebook) Return the first ChildPlace filtered by the facebook column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByRrss(string $rrss) Return the first ChildPlace filtered by the rrss column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByBasicFeatures(string $basic_features) Return the first ChildPlace filtered by the basic_features column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByOpeningHours(string $opening_hours) Return the first ChildPlace filtered by the opening_hours column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByUserQuestions(string $user_questions) Return the first ChildPlace filtered by the user_questions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByConfiguration(string $configuration) Return the first ChildPlace filtered by the configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByCompanyId(int $company_id) Return the first ChildPlace filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneBySubscriptionId(int $subscription_id) Return the first ChildPlace filtered by the subscription_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByStatusId(int $status_id) Return the first ChildPlace filtered by the status_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByIsAffiliate(boolean $is_affiliate) Return the first ChildPlace filtered by the is_affiliate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByCreatedBy(int $created_by) Return the first ChildPlace filtered by the created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByManagedBy(string $managed_by) Return the first ChildPlace filtered by the managed_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneBySlug(string $slug) Return the first ChildPlace filtered by the slug column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByCreatedAt(string $created_at) Return the first ChildPlace filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByUpdatedAt(string $updated_at) Return the first ChildPlace filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByTotalSubscribers(int $total_subscribers) Return the first ChildPlace filtered by the total_subscribers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByTotalFavorites(int $total_favorites) Return the first ChildPlace filtered by the total_favorites column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByTotalDiary(int $total_diary) Return the first ChildPlace filtered by the total_diary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByVipSubscribers(int $vip_subscribers) Return the first ChildPlace filtered by the vip_subscribers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlace requireOneByLastSubscriber(int $last_subscriber) Return the first ChildPlace filtered by the last_subscriber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPlace[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPlace objects based on current ModelCriteria
 * @method     ChildPlace[]|ObjectCollection findById(int $id) Return ChildPlace objects filtered by the id column
 * @method     ChildPlace[]|ObjectCollection findByName(string $name) Return ChildPlace objects filtered by the name column
 * @method     ChildPlace[]|ObjectCollection findByTagline(string $tagline) Return ChildPlace objects filtered by the tagline column
 * @method     ChildPlace[]|ObjectCollection findByDescription(string $description) Return ChildPlace objects filtered by the description column
 * @method     ChildPlace[]|ObjectCollection findByRoadtypeId(int $roadtype_id) Return ChildPlace objects filtered by the roadtype_id column
 * @method     ChildPlace[]|ObjectCollection findByAddress(string $address) Return ChildPlace objects filtered by the address column
 * @method     ChildPlace[]|ObjectCollection findByCityId(int $city_id) Return ChildPlace objects filtered by the city_id column
 * @method     ChildPlace[]|ObjectCollection findByZipcode(string $zipcode) Return ChildPlace objects filtered by the zipcode column
 * @method     ChildPlace[]|ObjectCollection findByProvinceId(int $province_id) Return ChildPlace objects filtered by the province_id column
 * @method     ChildPlace[]|ObjectCollection findByCountryId(int $country_id) Return ChildPlace objects filtered by the country_id column
 * @method     ChildPlace[]|ObjectCollection findByLatitude(double $latitude) Return ChildPlace objects filtered by the latitude column
 * @method     ChildPlace[]|ObjectCollection findByLongitude(double $longitude) Return ChildPlace objects filtered by the longitude column
 * @method     ChildPlace[]|ObjectCollection findByPhone(string $phone) Return ChildPlace objects filtered by the phone column
 * @method     ChildPlace[]|ObjectCollection findByEmail(string $email) Return ChildPlace objects filtered by the email column
 * @method     ChildPlace[]|ObjectCollection findByWebsite(string $website) Return ChildPlace objects filtered by the website column
 * @method     ChildPlace[]|ObjectCollection findByFacebook(string $facebook) Return ChildPlace objects filtered by the facebook column
 * @method     ChildPlace[]|ObjectCollection findByRrss(string $rrss) Return ChildPlace objects filtered by the rrss column
 * @method     ChildPlace[]|ObjectCollection findByBasicFeatures(string $basic_features) Return ChildPlace objects filtered by the basic_features column
 * @method     ChildPlace[]|ObjectCollection findByOpeningHours(string $opening_hours) Return ChildPlace objects filtered by the opening_hours column
 * @method     ChildPlace[]|ObjectCollection findByUserQuestions(string $user_questions) Return ChildPlace objects filtered by the user_questions column
 * @method     ChildPlace[]|ObjectCollection findByConfiguration(string $configuration) Return ChildPlace objects filtered by the configuration column
 * @method     ChildPlace[]|ObjectCollection findByCompanyId(int $company_id) Return ChildPlace objects filtered by the company_id column
 * @method     ChildPlace[]|ObjectCollection findBySubscriptionId(int $subscription_id) Return ChildPlace objects filtered by the subscription_id column
 * @method     ChildPlace[]|ObjectCollection findByStatusId(int $status_id) Return ChildPlace objects filtered by the status_id column
 * @method     ChildPlace[]|ObjectCollection findByIsAffiliate(boolean $is_affiliate) Return ChildPlace objects filtered by the is_affiliate column
 * @method     ChildPlace[]|ObjectCollection findByCreatedBy(int $created_by) Return ChildPlace objects filtered by the created_by column
 * @method     ChildPlace[]|ObjectCollection findByManagedBy(string $managed_by) Return ChildPlace objects filtered by the managed_by column
 * @method     ChildPlace[]|ObjectCollection findBySlug(string $slug) Return ChildPlace objects filtered by the slug column
 * @method     ChildPlace[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPlace objects filtered by the created_at column
 * @method     ChildPlace[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPlace objects filtered by the updated_at column
 * @method     ChildPlace[]|ObjectCollection findByTotalSubscribers(int $total_subscribers) Return ChildPlace objects filtered by the total_subscribers column
 * @method     ChildPlace[]|ObjectCollection findByTotalFavorites(int $total_favorites) Return ChildPlace objects filtered by the total_favorites column
 * @method     ChildPlace[]|ObjectCollection findByTotalDiary(int $total_diary) Return ChildPlace objects filtered by the total_diary column
 * @method     ChildPlace[]|ObjectCollection findByVipSubscribers(int $vip_subscribers) Return ChildPlace objects filtered by the vip_subscribers column
 * @method     ChildPlace[]|ObjectCollection findByLastSubscriber(int $last_subscriber) Return ChildPlace objects filtered by the last_subscriber column
 * @method     ChildPlace[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PlaceQuery extends ModelCriteria
{

    // data_cache behavior

    protected $cacheKey      = '';
    protected $cacheLocale   = '';
    protected $cacheEnable   = true;
    protected $cacheLifeTime = 3600;
            protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PlaceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tlf', $modelName = '\\Place', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPlaceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPlaceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPlaceQuery) {
            return $criteria;
        }
        $query = new ChildPlaceQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPlace|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PlaceTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PlaceTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->filterByPrimaryKey($key)->findOne($con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlace A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, tagline, description, roadtype_id, address, city_id, zipcode, province_id, country_id, latitude, longitude, phone, email, website, facebook, rrss, basic_features, opening_hours, user_questions, configuration, company_id, subscription_id, status_id, is_affiliate, created_by, managed_by, slug, created_at, updated_at, total_subscribers, total_favorites, total_diary, vip_subscribers, last_subscriber FROM public.place WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPlace $obj */
            $obj = new ChildPlace();
            $obj->hydrate($row);
            PlaceTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPlace|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PlaceTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PlaceTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the tagline column
     *
     * Example usage:
     * <code>
     * $query->filterByTagline('fooValue');   // WHERE tagline = 'fooValue'
     * $query->filterByTagline('%fooValue%'); // WHERE tagline LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tagline The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByTagline($tagline = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tagline)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tagline)) {
                $tagline = str_replace('*', '%', $tagline);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_TAGLINE, $tagline, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the roadtype_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoadtypeId(1234); // WHERE roadtype_id = 1234
     * $query->filterByRoadtypeId(array(12, 34)); // WHERE roadtype_id IN (12, 34)
     * $query->filterByRoadtypeId(array('min' => 12)); // WHERE roadtype_id > 12
     * </code>
     *
     * @see       filterByRoadType()
     *
     * @param     mixed $roadtypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByRoadtypeId($roadtypeId = null, $comparison = null)
    {
        if (is_array($roadtypeId)) {
            $useMinMax = false;
            if (isset($roadtypeId['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_ROADTYPE_ID, $roadtypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roadtypeId['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_ROADTYPE_ID, $roadtypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_ROADTYPE_ID, $roadtypeId, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the city_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCityId(1234); // WHERE city_id = 1234
     * $query->filterByCityId(array(12, 34)); // WHERE city_id IN (12, 34)
     * $query->filterByCityId(array('min' => 12)); // WHERE city_id > 12
     * </code>
     *
     * @see       filterByCity()
     *
     * @param     mixed $cityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByCityId($cityId = null, $comparison = null)
    {
        if (is_array($cityId)) {
            $useMinMax = false;
            if (isset($cityId['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_CITY_ID, $cityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityId['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_CITY_ID, $cityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_CITY_ID, $cityId, $comparison);
    }

    /**
     * Filter the query on the zipcode column
     *
     * Example usage:
     * <code>
     * $query->filterByZipcode('fooValue');   // WHERE zipcode = 'fooValue'
     * $query->filterByZipcode('%fooValue%'); // WHERE zipcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zipcode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByZipcode($zipcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipcode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $zipcode)) {
                $zipcode = str_replace('*', '%', $zipcode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_ZIPCODE, $zipcode, $comparison);
    }

    /**
     * Filter the query on the province_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProvinceId(1234); // WHERE province_id = 1234
     * $query->filterByProvinceId(array(12, 34)); // WHERE province_id IN (12, 34)
     * $query->filterByProvinceId(array('min' => 12)); // WHERE province_id > 12
     * </code>
     *
     * @see       filterByProvince()
     *
     * @param     mixed $provinceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByProvinceId($provinceId = null, $comparison = null)
    {
        if (is_array($provinceId)) {
            $useMinMax = false;
            if (isset($provinceId['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_PROVINCE_ID, $provinceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($provinceId['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_PROVINCE_ID, $provinceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_PROVINCE_ID, $provinceId, $comparison);
    }

    /**
     * Filter the query on the country_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryId(1234); // WHERE country_id = 1234
     * $query->filterByCountryId(array(12, 34)); // WHERE country_id IN (12, 34)
     * $query->filterByCountryId(array('min' => 12)); // WHERE country_id > 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $countryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByCountryId($countryId = null, $comparison = null)
    {
        if (is_array($countryId)) {
            $useMinMax = false;
            if (isset($countryId['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_COUNTRY_ID, $countryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryId['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_COUNTRY_ID, $countryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_COUNTRY_ID, $countryId, $comparison);
    }

    /**
     * Filter the query on the latitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitude(1234); // WHERE latitude = 1234
     * $query->filterByLatitude(array(12, 34)); // WHERE latitude IN (12, 34)
     * $query->filterByLatitude(array('min' => 12)); // WHERE latitude > 12
     * </code>
     *
     * @param     mixed $latitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByLatitude($latitude = null, $comparison = null)
    {
        if (is_array($latitude)) {
            $useMinMax = false;
            if (isset($latitude['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_LATITUDE, $latitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($latitude['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_LATITUDE, $latitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_LATITUDE, $latitude, $comparison);
    }

    /**
     * Filter the query on the longitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitude(1234); // WHERE longitude = 1234
     * $query->filterByLongitude(array(12, 34)); // WHERE longitude IN (12, 34)
     * $query->filterByLongitude(array('min' => 12)); // WHERE longitude > 12
     * </code>
     *
     * @param     mixed $longitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByLongitude($longitude = null, $comparison = null)
    {
        if (is_array($longitude)) {
            $useMinMax = false;
            if (isset($longitude['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_LONGITUDE, $longitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longitude['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_LONGITUDE, $longitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_LONGITUDE, $longitude, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the website column
     *
     * Example usage:
     * <code>
     * $query->filterByWebsite('fooValue');   // WHERE website = 'fooValue'
     * $query->filterByWebsite('%fooValue%'); // WHERE website LIKE '%fooValue%'
     * </code>
     *
     * @param     string $website The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByWebsite($website = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($website)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $website)) {
                $website = str_replace('*', '%', $website);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_WEBSITE, $website, $comparison);
    }

    /**
     * Filter the query on the facebook column
     *
     * Example usage:
     * <code>
     * $query->filterByFacebook('fooValue');   // WHERE facebook = 'fooValue'
     * $query->filterByFacebook('%fooValue%'); // WHERE facebook LIKE '%fooValue%'
     * </code>
     *
     * @param     string $facebook The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByFacebook($facebook = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($facebook)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $facebook)) {
                $facebook = str_replace('*', '%', $facebook);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_FACEBOOK, $facebook, $comparison);
    }

    /**
     * Filter the query on the rrss column
     *
     * Example usage:
     * <code>
     * $query->filterByRrss('fooValue');   // WHERE rrss = 'fooValue'
     * $query->filterByRrss('%fooValue%'); // WHERE rrss LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rrss The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByRrss($rrss = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rrss)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rrss)) {
                $rrss = str_replace('*', '%', $rrss);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_RRSS, $rrss, $comparison);
    }

    /**
     * Filter the query on the basic_features column
     *
     * Example usage:
     * <code>
     * $query->filterByBasicFeatures('fooValue');   // WHERE basic_features = 'fooValue'
     * $query->filterByBasicFeatures('%fooValue%'); // WHERE basic_features LIKE '%fooValue%'
     * </code>
     *
     * @param     string $basicFeatures The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByBasicFeatures($basicFeatures = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($basicFeatures)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $basicFeatures)) {
                $basicFeatures = str_replace('*', '%', $basicFeatures);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_BASIC_FEATURES, $basicFeatures, $comparison);
    }

    /**
     * Filter the query on the opening_hours column
     *
     * Example usage:
     * <code>
     * $query->filterByOpeningHours('fooValue');   // WHERE opening_hours = 'fooValue'
     * $query->filterByOpeningHours('%fooValue%'); // WHERE opening_hours LIKE '%fooValue%'
     * </code>
     *
     * @param     string $openingHours The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByOpeningHours($openingHours = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($openingHours)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $openingHours)) {
                $openingHours = str_replace('*', '%', $openingHours);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_OPENING_HOURS, $openingHours, $comparison);
    }

    /**
     * Filter the query on the user_questions column
     *
     * Example usage:
     * <code>
     * $query->filterByUserQuestions('fooValue');   // WHERE user_questions = 'fooValue'
     * $query->filterByUserQuestions('%fooValue%'); // WHERE user_questions LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userQuestions The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByUserQuestions($userQuestions = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userQuestions)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userQuestions)) {
                $userQuestions = str_replace('*', '%', $userQuestions);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_USER_QUESTIONS, $userQuestions, $comparison);
    }

    /**
     * Filter the query on the configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByConfiguration('fooValue');   // WHERE configuration = 'fooValue'
     * $query->filterByConfiguration('%fooValue%'); // WHERE configuration LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configuration The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByConfiguration($configuration = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configuration)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configuration)) {
                $configuration = str_replace('*', '%', $configuration);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_CONFIGURATION, $configuration, $comparison);
    }

    /**
     * Filter the query on the company_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyId(1234); // WHERE company_id = 1234
     * $query->filterByCompanyId(array(12, 34)); // WHERE company_id IN (12, 34)
     * $query->filterByCompanyId(array('min' => 12)); // WHERE company_id > 12
     * </code>
     *
     * @see       filterByCompany()
     *
     * @param     mixed $companyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByCompanyId($companyId = null, $comparison = null)
    {
        if (is_array($companyId)) {
            $useMinMax = false;
            if (isset($companyId['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_COMPANY_ID, $companyId, $comparison);
    }

    /**
     * Filter the query on the subscription_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySubscriptionId(1234); // WHERE subscription_id = 1234
     * $query->filterBySubscriptionId(array(12, 34)); // WHERE subscription_id IN (12, 34)
     * $query->filterBySubscriptionId(array('min' => 12)); // WHERE subscription_id > 12
     * </code>
     *
     * @see       filterBySubscription()
     *
     * @param     mixed $subscriptionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterBySubscriptionId($subscriptionId = null, $comparison = null)
    {
        if (is_array($subscriptionId)) {
            $useMinMax = false;
            if (isset($subscriptionId['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_SUBSCRIPTION_ID, $subscriptionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subscriptionId['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_SUBSCRIPTION_ID, $subscriptionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_SUBSCRIPTION_ID, $subscriptionId, $comparison);
    }

    /**
     * Filter the query on the status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusId(1234); // WHERE status_id = 1234
     * $query->filterByStatusId(array(12, 34)); // WHERE status_id IN (12, 34)
     * $query->filterByStatusId(array('min' => 12)); // WHERE status_id > 12
     * </code>
     *
     * @see       filterByStatus()
     *
     * @param     mixed $statusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByStatusId($statusId = null, $comparison = null)
    {
        if (is_array($statusId)) {
            $useMinMax = false;
            if (isset($statusId['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_STATUS_ID, $statusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusId['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_STATUS_ID, $statusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_STATUS_ID, $statusId, $comparison);
    }

    /**
     * Filter the query on the is_affiliate column
     *
     * Example usage:
     * <code>
     * $query->filterByIsAffiliate(true); // WHERE is_affiliate = true
     * $query->filterByIsAffiliate('yes'); // WHERE is_affiliate = true
     * </code>
     *
     * @param     boolean|string $isAffiliate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByIsAffiliate($isAffiliate = null, $comparison = null)
    {
        if (is_string($isAffiliate)) {
            $isAffiliate = in_array(strtolower($isAffiliate), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PlaceTableMap::COL_IS_AFFILIATE, $isAffiliate, $comparison);
    }

    /**
     * Filter the query on the created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedBy(1234); // WHERE created_by = 1234
     * $query->filterByCreatedBy(array(12, 34)); // WHERE created_by IN (12, 34)
     * $query->filterByCreatedBy(array('min' => 12)); // WHERE created_by > 12
     * </code>
     *
     * @see       filterByOwner()
     *
     * @param     mixed $createdBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_CREATED_BY, $createdBy, $comparison);
    }

    /**
     * Filter the query on the managed_by column
     *
     * Example usage:
     * <code>
     * $query->filterByManagedBy('fooValue');   // WHERE managed_by = 'fooValue'
     * $query->filterByManagedBy('%fooValue%'); // WHERE managed_by LIKE '%fooValue%'
     * </code>
     *
     * @param     string $managedBy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByManagedBy($managedBy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($managedBy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $managedBy)) {
                $managedBy = str_replace('*', '%', $managedBy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_MANAGED_BY, $managedBy, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the total_subscribers column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalSubscribers(1234); // WHERE total_subscribers = 1234
     * $query->filterByTotalSubscribers(array(12, 34)); // WHERE total_subscribers IN (12, 34)
     * $query->filterByTotalSubscribers(array('min' => 12)); // WHERE total_subscribers > 12
     * </code>
     *
     * @param     mixed $totalSubscribers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByTotalSubscribers($totalSubscribers = null, $comparison = null)
    {
        if (is_array($totalSubscribers)) {
            $useMinMax = false;
            if (isset($totalSubscribers['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_TOTAL_SUBSCRIBERS, $totalSubscribers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalSubscribers['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_TOTAL_SUBSCRIBERS, $totalSubscribers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_TOTAL_SUBSCRIBERS, $totalSubscribers, $comparison);
    }

    /**
     * Filter the query on the total_favorites column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalFavorites(1234); // WHERE total_favorites = 1234
     * $query->filterByTotalFavorites(array(12, 34)); // WHERE total_favorites IN (12, 34)
     * $query->filterByTotalFavorites(array('min' => 12)); // WHERE total_favorites > 12
     * </code>
     *
     * @param     mixed $totalFavorites The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByTotalFavorites($totalFavorites = null, $comparison = null)
    {
        if (is_array($totalFavorites)) {
            $useMinMax = false;
            if (isset($totalFavorites['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_TOTAL_FAVORITES, $totalFavorites['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalFavorites['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_TOTAL_FAVORITES, $totalFavorites['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_TOTAL_FAVORITES, $totalFavorites, $comparison);
    }

    /**
     * Filter the query on the total_diary column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalDiary(1234); // WHERE total_diary = 1234
     * $query->filterByTotalDiary(array(12, 34)); // WHERE total_diary IN (12, 34)
     * $query->filterByTotalDiary(array('min' => 12)); // WHERE total_diary > 12
     * </code>
     *
     * @param     mixed $totalDiary The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByTotalDiary($totalDiary = null, $comparison = null)
    {
        if (is_array($totalDiary)) {
            $useMinMax = false;
            if (isset($totalDiary['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_TOTAL_DIARY, $totalDiary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalDiary['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_TOTAL_DIARY, $totalDiary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_TOTAL_DIARY, $totalDiary, $comparison);
    }

    /**
     * Filter the query on the vip_subscribers column
     *
     * Example usage:
     * <code>
     * $query->filterByVipSubscribers(1234); // WHERE vip_subscribers = 1234
     * $query->filterByVipSubscribers(array(12, 34)); // WHERE vip_subscribers IN (12, 34)
     * $query->filterByVipSubscribers(array('min' => 12)); // WHERE vip_subscribers > 12
     * </code>
     *
     * @param     mixed $vipSubscribers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByVipSubscribers($vipSubscribers = null, $comparison = null)
    {
        if (is_array($vipSubscribers)) {
            $useMinMax = false;
            if (isset($vipSubscribers['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_VIP_SUBSCRIBERS, $vipSubscribers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vipSubscribers['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_VIP_SUBSCRIBERS, $vipSubscribers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_VIP_SUBSCRIBERS, $vipSubscribers, $comparison);
    }

    /**
     * Filter the query on the last_subscriber column
     *
     * Example usage:
     * <code>
     * $query->filterByLastSubscriber(1234); // WHERE last_subscriber = 1234
     * $query->filterByLastSubscriber(array(12, 34)); // WHERE last_subscriber IN (12, 34)
     * $query->filterByLastSubscriber(array('min' => 12)); // WHERE last_subscriber > 12
     * </code>
     *
     * @param     mixed $lastSubscriber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByLastSubscriber($lastSubscriber = null, $comparison = null)
    {
        if (is_array($lastSubscriber)) {
            $useMinMax = false;
            if (isset($lastSubscriber['min'])) {
                $this->addUsingAlias(PlaceTableMap::COL_LAST_SUBSCRIBER, $lastSubscriber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastSubscriber['max'])) {
                $this->addUsingAlias(PlaceTableMap::COL_LAST_SUBSCRIBER, $lastSubscriber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlaceTableMap::COL_LAST_SUBSCRIBER, $lastSubscriber, $comparison);
    }

    /**
     * Filter the query by a related \RoadType object
     *
     * @param \RoadType|ObjectCollection $roadType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByRoadType($roadType, $comparison = null)
    {
        if ($roadType instanceof \RoadType) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ROADTYPE_ID, $roadType->getId(), $comparison);
        } elseif ($roadType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlaceTableMap::COL_ROADTYPE_ID, $roadType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRoadType() only accepts arguments of type \RoadType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RoadType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinRoadType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RoadType');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'RoadType');
        }

        return $this;
    }

    /**
     * Use the RoadType relation RoadType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RoadTypeQuery A secondary query class using the current class as primary query
     */
    public function useRoadTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRoadType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RoadType', '\RoadTypeQuery');
    }

    /**
     * Filter the query by a related \City object
     *
     * @param \City|ObjectCollection $city The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByCity($city, $comparison = null)
    {
        if ($city instanceof \City) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_CITY_ID, $city->getId(), $comparison);
        } elseif ($city instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlaceTableMap::COL_CITY_ID, $city->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCity() only accepts arguments of type \City or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the City relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinCity($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('City');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'City');
        }

        return $this;
    }

    /**
     * Use the City relation City object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CityQuery A secondary query class using the current class as primary query
     */
    public function useCityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'City', '\CityQuery');
    }

    /**
     * Filter the query by a related \Province object
     *
     * @param \Province|ObjectCollection $province The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByProvince($province, $comparison = null)
    {
        if ($province instanceof \Province) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_PROVINCE_ID, $province->getId(), $comparison);
        } elseif ($province instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlaceTableMap::COL_PROVINCE_ID, $province->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProvince() only accepts arguments of type \Province or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Province relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinProvince($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Province');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Province');
        }

        return $this;
    }

    /**
     * Use the Province relation Province object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProvinceQuery A secondary query class using the current class as primary query
     */
    public function useProvinceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProvince($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Province', '\ProvinceQuery');
    }

    /**
     * Filter the query by a related \Country object
     *
     * @param \Country|ObjectCollection $country The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof \Country) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_COUNTRY_ID, $country->getId(), $comparison);
        } elseif ($country instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlaceTableMap::COL_COUNTRY_ID, $country->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type \Country or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation Country object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\CountryQuery');
    }

    /**
     * Filter the query by a related \Company object
     *
     * @param \Company|ObjectCollection $company The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByCompany($company, $comparison = null)
    {
        if ($company instanceof \Company) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_COMPANY_ID, $company->getId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlaceTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCompany() only accepts arguments of type \Company or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Company relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinCompany($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Company');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Company');
        }

        return $this;
    }

    /**
     * Use the Company relation Company object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompany($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Company', '\CompanyQuery');
    }

    /**
     * Filter the query by a related \Subscription object
     *
     * @param \Subscription|ObjectCollection $subscription The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterBySubscription($subscription, $comparison = null)
    {
        if ($subscription instanceof \Subscription) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_SUBSCRIPTION_ID, $subscription->getId(), $comparison);
        } elseif ($subscription instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlaceTableMap::COL_SUBSCRIPTION_ID, $subscription->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySubscription() only accepts arguments of type \Subscription or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Subscription relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinSubscription($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Subscription');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Subscription');
        }

        return $this;
    }

    /**
     * Use the Subscription relation Subscription object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SubscriptionQuery A secondary query class using the current class as primary query
     */
    public function useSubscriptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSubscription($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Subscription', '\SubscriptionQuery');
    }

    /**
     * Filter the query by a related \Status object
     *
     * @param \Status|ObjectCollection $status The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByStatus($status, $comparison = null)
    {
        if ($status instanceof \Status) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_STATUS_ID, $status->getId(), $comparison);
        } elseif ($status instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlaceTableMap::COL_STATUS_ID, $status->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStatus() only accepts arguments of type \Status or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Status relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Status');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Status');
        }

        return $this;
    }

    /**
     * Use the Status relation Status object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StatusQuery A secondary query class using the current class as primary query
     */
    public function useStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Status', '\StatusQuery');
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByOwner($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_CREATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlaceTableMap::COL_CREATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOwner() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Owner relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinOwner($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Owner');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Owner');
        }

        return $this;
    }

    /**
     * Use the Owner relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useOwnerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOwner($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Owner', '\UserQuery');
    }

    /**
     * Filter the query by a related \PlacePlaceType object
     *
     * @param \PlacePlaceType|ObjectCollection $placePlaceType the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPlacePlaceType($placePlaceType, $comparison = null)
    {
        if ($placePlaceType instanceof \PlacePlaceType) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $placePlaceType->getPlaceId(), $comparison);
        } elseif ($placePlaceType instanceof ObjectCollection) {
            return $this
                ->usePlacePlaceTypeQuery()
                ->filterByPrimaryKeys($placePlaceType->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPlacePlaceType() only accepts arguments of type \PlacePlaceType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlacePlaceType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinPlacePlaceType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlacePlaceType');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PlacePlaceType');
        }

        return $this;
    }

    /**
     * Use the PlacePlaceType relation PlacePlaceType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PlacePlaceTypeQuery A secondary query class using the current class as primary query
     */
    public function usePlacePlaceTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlacePlaceType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlacePlaceType', '\PlacePlaceTypeQuery');
    }

    /**
     * Filter the query by a related \PlaceLocation object
     *
     * @param \PlaceLocation|ObjectCollection $placeLocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPlaceLocation($placeLocation, $comparison = null)
    {
        if ($placeLocation instanceof \PlaceLocation) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $placeLocation->getPlaceId(), $comparison);
        } elseif ($placeLocation instanceof ObjectCollection) {
            return $this
                ->usePlaceLocationQuery()
                ->filterByPrimaryKeys($placeLocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPlaceLocation() only accepts arguments of type \PlaceLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlaceLocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinPlaceLocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlaceLocation');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PlaceLocation');
        }

        return $this;
    }

    /**
     * Use the PlaceLocation relation PlaceLocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PlaceLocationQuery A secondary query class using the current class as primary query
     */
    public function usePlaceLocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlaceLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlaceLocation', '\PlaceLocationQuery');
    }

    /**
     * Filter the query by a related \PlaceTarget object
     *
     * @param \PlaceTarget|ObjectCollection $placeTarget the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPlaceTarget($placeTarget, $comparison = null)
    {
        if ($placeTarget instanceof \PlaceTarget) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $placeTarget->getPlaceId(), $comparison);
        } elseif ($placeTarget instanceof ObjectCollection) {
            return $this
                ->usePlaceTargetQuery()
                ->filterByPrimaryKeys($placeTarget->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPlaceTarget() only accepts arguments of type \PlaceTarget or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlaceTarget relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinPlaceTarget($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlaceTarget');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PlaceTarget');
        }

        return $this;
    }

    /**
     * Use the PlaceTarget relation PlaceTarget object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PlaceTargetQuery A secondary query class using the current class as primary query
     */
    public function usePlaceTargetQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlaceTarget($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlaceTarget', '\PlaceTargetQuery');
    }

    /**
     * Filter the query by a related \PlaceFeature object
     *
     * @param \PlaceFeature|ObjectCollection $placeFeature the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPlaceFeature($placeFeature, $comparison = null)
    {
        if ($placeFeature instanceof \PlaceFeature) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $placeFeature->getPlaceId(), $comparison);
        } elseif ($placeFeature instanceof ObjectCollection) {
            return $this
                ->usePlaceFeatureQuery()
                ->filterByPrimaryKeys($placeFeature->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPlaceFeature() only accepts arguments of type \PlaceFeature or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlaceFeature relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinPlaceFeature($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlaceFeature');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PlaceFeature');
        }

        return $this;
    }

    /**
     * Use the PlaceFeature relation PlaceFeature object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PlaceFeatureQuery A secondary query class using the current class as primary query
     */
    public function usePlaceFeatureQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlaceFeature($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlaceFeature', '\PlaceFeatureQuery');
    }

    /**
     * Filter the query by a related \PlaceKnowus object
     *
     * @param \PlaceKnowus|ObjectCollection $placeKnowus the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPlaceKnowus($placeKnowus, $comparison = null)
    {
        if ($placeKnowus instanceof \PlaceKnowus) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $placeKnowus->getPlaceId(), $comparison);
        } elseif ($placeKnowus instanceof ObjectCollection) {
            return $this
                ->usePlaceKnowusQuery()
                ->filterByPrimaryKeys($placeKnowus->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPlaceKnowus() only accepts arguments of type \PlaceKnowus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlaceKnowus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinPlaceKnowus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlaceKnowus');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PlaceKnowus');
        }

        return $this;
    }

    /**
     * Use the PlaceKnowus relation PlaceKnowus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PlaceKnowusQuery A secondary query class using the current class as primary query
     */
    public function usePlaceKnowusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlaceKnowus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlaceKnowus', '\PlaceKnowusQuery');
    }

    /**
     * Filter the query by a related \Delivery object
     *
     * @param \Delivery|ObjectCollection $delivery the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByDelivery($delivery, $comparison = null)
    {
        if ($delivery instanceof \Delivery) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $delivery->getPlaceId(), $comparison);
        } elseif ($delivery instanceof ObjectCollection) {
            return $this
                ->useDeliveryQuery()
                ->filterByPrimaryKeys($delivery->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDelivery() only accepts arguments of type \Delivery or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Delivery relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinDelivery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Delivery');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Delivery');
        }

        return $this;
    }

    /**
     * Use the Delivery relation Delivery object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DeliveryQuery A secondary query class using the current class as primary query
     */
    public function useDeliveryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDelivery($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Delivery', '\DeliveryQuery');
    }

    /**
     * Filter the query by a related \Event object
     *
     * @param \Event|ObjectCollection $event the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByEvent($event, $comparison = null)
    {
        if ($event instanceof \Event) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $event->getPlaceId(), $comparison);
        } elseif ($event instanceof ObjectCollection) {
            return $this
                ->useEventQuery()
                ->filterByPrimaryKeys($event->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEvent() only accepts arguments of type \Event or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Event relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinEvent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Event');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Event');
        }

        return $this;
    }

    /**
     * Use the Event relation Event object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EventQuery A secondary query class using the current class as primary query
     */
    public function useEventQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Event', '\EventQuery');
    }

    /**
     * Filter the query by a related \FoodTypePlace object
     *
     * @param \FoodTypePlace|ObjectCollection $foodTypePlace the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByFoodTypePlace($foodTypePlace, $comparison = null)
    {
        if ($foodTypePlace instanceof \FoodTypePlace) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $foodTypePlace->getPlaceId(), $comparison);
        } elseif ($foodTypePlace instanceof ObjectCollection) {
            return $this
                ->useFoodTypePlaceQuery()
                ->filterByPrimaryKeys($foodTypePlace->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFoodTypePlace() only accepts arguments of type \FoodTypePlace or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FoodTypePlace relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinFoodTypePlace($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FoodTypePlace');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FoodTypePlace');
        }

        return $this;
    }

    /**
     * Use the FoodTypePlace relation FoodTypePlace object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FoodTypePlaceQuery A secondary query class using the current class as primary query
     */
    public function useFoodTypePlaceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFoodTypePlace($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FoodTypePlace', '\FoodTypePlaceQuery');
    }

    /**
     * Filter the query by a related \Picture object
     *
     * @param \Picture|ObjectCollection $picture the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPicture($picture, $comparison = null)
    {
        if ($picture instanceof \Picture) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $picture->getPlaceId(), $comparison);
        } elseif ($picture instanceof ObjectCollection) {
            return $this
                ->usePictureQuery()
                ->filterByPrimaryKeys($picture->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPicture() only accepts arguments of type \Picture or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Picture relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinPicture($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Picture');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Picture');
        }

        return $this;
    }

    /**
     * Use the Picture relation Picture object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PictureQuery A secondary query class using the current class as primary query
     */
    public function usePictureQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPicture($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Picture', '\PictureQuery');
    }

    /**
     * Filter the query by a related \PictureFolder object
     *
     * @param \PictureFolder|ObjectCollection $pictureFolder the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPictureFolder($pictureFolder, $comparison = null)
    {
        if ($pictureFolder instanceof \PictureFolder) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $pictureFolder->getPlaceId(), $comparison);
        } elseif ($pictureFolder instanceof ObjectCollection) {
            return $this
                ->usePictureFolderQuery()
                ->filterByPrimaryKeys($pictureFolder->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPictureFolder() only accepts arguments of type \PictureFolder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PictureFolder relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinPictureFolder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PictureFolder');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PictureFolder');
        }

        return $this;
    }

    /**
     * Use the PictureFolder relation PictureFolder object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PictureFolderQuery A secondary query class using the current class as primary query
     */
    public function usePictureFolderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPictureFolder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PictureFolder', '\PictureFolderQuery');
    }

    /**
     * Filter the query by a related \Unsubscription object
     *
     * @param \Unsubscription|ObjectCollection $unsubscription the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByUnsubscription($unsubscription, $comparison = null)
    {
        if ($unsubscription instanceof \Unsubscription) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $unsubscription->getPlaceId(), $comparison);
        } elseif ($unsubscription instanceof ObjectCollection) {
            return $this
                ->useUnsubscriptionQuery()
                ->filterByPrimaryKeys($unsubscription->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUnsubscription() only accepts arguments of type \Unsubscription or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Unsubscription relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinUnsubscription($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Unsubscription');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Unsubscription');
        }

        return $this;
    }

    /**
     * Use the Unsubscription relation Unsubscription object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UnsubscriptionQuery A secondary query class using the current class as primary query
     */
    public function useUnsubscriptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUnsubscription($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Unsubscription', '\UnsubscriptionQuery');
    }

    /**
     * Filter the query by a related \SubscriberPlace object
     *
     * @param \SubscriberPlace|ObjectCollection $subscriberPlace the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterBySubscriberPlace($subscriberPlace, $comparison = null)
    {
        if ($subscriberPlace instanceof \SubscriberPlace) {
            return $this
                ->addUsingAlias(PlaceTableMap::COL_ID, $subscriberPlace->getPlaceId(), $comparison);
        } elseif ($subscriberPlace instanceof ObjectCollection) {
            return $this
                ->useSubscriberPlaceQuery()
                ->filterByPrimaryKeys($subscriberPlace->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySubscriberPlace() only accepts arguments of type \SubscriberPlace or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SubscriberPlace relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function joinSubscriberPlace($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SubscriberPlace');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SubscriberPlace');
        }

        return $this;
    }

    /**
     * Use the SubscriberPlace relation SubscriberPlace object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SubscriberPlaceQuery A secondary query class using the current class as primary query
     */
    public function useSubscriberPlaceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSubscriberPlace($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SubscriberPlace', '\SubscriberPlaceQuery');
    }

    /**
     * Filter the query by a related PlaceType object
     * using the public.place_place_type table as cross reference
     *
     * @param PlaceType $placeType the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByPlaceType($placeType, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePlacePlaceTypeQuery()
            ->filterByPlaceType($placeType, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Location object
     * using the public.place_location table as cross reference
     *
     * @param Location $location the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByLocation($location, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePlaceLocationQuery()
            ->filterByLocation($location, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Target object
     * using the public.place_target table as cross reference
     *
     * @param Target $target the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByTarget($target, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePlaceTargetQuery()
            ->filterByTarget($target, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Feature object
     * using the public.place_feature table as cross reference
     *
     * @param Feature $feature the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByFeature($feature, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePlaceFeatureQuery()
            ->filterByFeature($feature, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Knowus object
     * using the public.place_knowus table as cross reference
     *
     * @param Knowus $knowus the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByKnowus($knowus, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePlaceKnowusQuery()
            ->filterByKnowus($knowus, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related FoodType object
     * using the public.food_type_place table as cross reference
     *
     * @param FoodType $foodType the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterByFoodType($foodType, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useFoodTypePlaceQuery()
            ->filterByFoodType($foodType, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Subscriber object
     * using the public.subscriber_place table as cross reference
     *
     * @param Subscriber $subscriber the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlaceQuery The current query, for fluid interface
     */
    public function filterBySubscriber($subscriber, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useSubscriberPlaceQuery()
            ->filterBySubscriber($subscriber, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPlace $place Object to remove from the list of results
     *
     * @return $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function prune($place = null)
    {
        if ($place) {
            $this->addUsingAlias(PlaceTableMap::COL_ID, $place->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePreDelete(ConnectionInterface $con)
    {
        // aggregate_column_relation_country_active_places behavior
        $this->findRelatedCountryActivePlacess($con);
        // aggregate_column_relation_country_total_places behavior
        $this->findRelatedCountryTotalPlacess($con);
        // aggregate_column_relation_province_active_places behavior
        $this->findRelatedProvinceActivePlacess($con);
        // aggregate_column_relation_province_total_places behavior
        $this->findRelatedProvinceTotalPlacess($con);
        // aggregate_column_relation_city_total_places behavior
        $this->findRelatedCityTotalPlacess($con);
        // aggregate_column_relation_city_active_places behavior
        $this->findRelatedCityActivePlacess($con);

        return $this->preDelete($con);
    }

    /**
     * Code to execute after every DELETE statement
     *
     * @param     int $affectedRows the number of deleted rows
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePostDelete($affectedRows, ConnectionInterface $con)
    {
        // data_cache behavior
        \PlaceQuery::purgeCache();
        // aggregate_column_relation_country_active_places behavior
        $this->updateRelatedCountryActivePlacess($con);
        // aggregate_column_relation_country_total_places behavior
        $this->updateRelatedCountryTotalPlacess($con);
        // aggregate_column_relation_province_active_places behavior
        $this->updateRelatedProvinceActivePlacess($con);
        // aggregate_column_relation_province_total_places behavior
        $this->updateRelatedProvinceTotalPlacess($con);
        // aggregate_column_relation_city_total_places behavior
        $this->updateRelatedCityTotalPlacess($con);
        // aggregate_column_relation_city_active_places behavior
        $this->updateRelatedCityActivePlacess($con);

        return $this->postDelete($affectedRows, $con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param     array $values The associative array of columns and values for the update
     * @param     ConnectionInterface $con The connection object used by the query
     * @param     boolean $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false)
    {
        // aggregate_column_relation_country_active_places behavior
        $this->findRelatedCountryActivePlacess($con);
        // aggregate_column_relation_country_total_places behavior
        $this->findRelatedCountryTotalPlacess($con);
        // aggregate_column_relation_province_active_places behavior
        $this->findRelatedProvinceActivePlacess($con);
        // aggregate_column_relation_province_total_places behavior
        $this->findRelatedProvinceTotalPlacess($con);
        // aggregate_column_relation_city_total_places behavior
        $this->findRelatedCityTotalPlacess($con);
        // aggregate_column_relation_city_active_places behavior
        $this->findRelatedCityActivePlacess($con);

        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Code to execute after every UPDATE statement
     *
     * @param     int $affectedRows the number of updated rows
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePostUpdate($affectedRows, ConnectionInterface $con)
    {
        // data_cache behavior
        \PlaceQuery::purgeCache();
        // aggregate_column_relation_country_active_places behavior
        $this->updateRelatedCountryActivePlacess($con);
        // aggregate_column_relation_country_total_places behavior
        $this->updateRelatedCountryTotalPlacess($con);
        // aggregate_column_relation_province_active_places behavior
        $this->updateRelatedProvinceActivePlacess($con);
        // aggregate_column_relation_province_total_places behavior
        $this->updateRelatedProvinceTotalPlacess($con);
        // aggregate_column_relation_city_total_places behavior
        $this->updateRelatedCityTotalPlacess($con);
        // aggregate_column_relation_city_active_places behavior
        $this->updateRelatedCityActivePlacess($con);

        return $this->postUpdate($affectedRows, $con);
    }

    /**
     * Deletes all rows from the public.place table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlaceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PlaceTableMap::clearInstancePool();
            PlaceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlaceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PlaceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PlaceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PlaceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PlaceTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PlaceTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PlaceTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PlaceTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PlaceTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildPlaceQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PlaceTableMap::COL_CREATED_AT);
    }

    // data_cache behavior

    public static function purgeCache()
    {
        return \Domino\CacheStore\Factory::factory('redis')->clearByNamespace(PlaceTableMap::TABLE_NAME);
    }

    public static function cacheFetch($key)
    {

        $result = \Domino\CacheStore\Factory::factory('redis')->get(PlaceTableMap::TABLE_NAME, $key);

        if ($result !== null) {
            if ($result instanceof \ArrayAccess) {
                foreach ($result as $element) {
                    if ($element instanceof \Place) {
                        PlaceTableMap::addInstanceToPool($element);
                    }
                }
            } else if ($result instanceof \Place) {
                PlaceTableMap::addInstanceToPool($result);
            }
        }

        return $result;


    }

    public static function cacheStore($key, $data, $lifetime)
    {
        return \Domino\CacheStore\Factory::factory('redis')->set(PlaceTableMap::TABLE_NAME, $key, $data, $lifetime);
    }

    public static function cacheDelete($key)
    {
        return \Domino\CacheStore\Factory::factory('redis')->clear(PlaceTableMap::TABLE_NAME, $key);
    }

    public function setCacheEnable()
    {
        $this->cacheEnable = true;

        return $this;
    }

    public function setCacheDisable()
    {
        $this->cacheEnable = false;

        return $this;
    }

    public function isCacheEnable()
    {
        return (bool)$this->cacheEnable;
    }

    public function getCacheKey()
    {
        if ($this->cacheKey) {
            return $this->cacheKey;
        }
        $params      = array();
        $sql_hash    = hash('md4', $this->createSelectSql($params));
        $params_hash = hash('md4', json_encode($params));
        $locale      = $this->cacheLocale ? '_' . $this->cacheLocale : '';
        $this->cacheKey = $sql_hash . '_' . $params_hash . $locale;

        return $this->cacheKey;
    }

    public function setCacheKey($cacheKey)
    {
        $this->cacheKey = $cacheKey;

        return $this;
    }

    public function setCacheLocale($locale)
    {
        $this->cacheLocale = $locale;

        return $this;
    }

    public function setLifeTime($lifetime)
    {
        $this->cacheLifeTime = $lifetime;

        return $this;
    }

    public function getLifeTime()
    {
        return $this->cacheLifeTime;
    }

    /**
     * Issue a SELECT query based on the current ModelCriteria
     * and format the list of results with the current formatter
     * By default, returns an array of model objects
     *
     * @param ConnectionInterface $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function find(ConnectionInterface $con = null)
    {
        if ($this->isCacheEnable() && $cache = \PlaceQuery::cacheFetch($this->getCacheKey())) {
            $data = new \Propel\Runtime\Collection\ObjectCollection();

            foreach($cache as $element)
            {
                $model = new \Place();
                $model->fromArray($element);
                $data->append($model);

            }

            return $data;
        }

        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria->doSelect($con);

        $data = $criteria->getFormatter()->init($criteria)->format($dataFetcher);

        if ($this->isCacheEnable()) {
            \PlaceQuery::cacheStore($this->getCacheKey(), $data->toArray(), $this->getLifeTime());
        }

        return $data;


    }

    /**
     * Issue a SELECT ... LIMIT 1 query based on the current ModelCriteria
     * and format the result with the current formatter
     * By default, returns a model object
     *
     * @param ConnectionInterface $con an optional connection object
     *
     * @return mixed the result, formatted by the current formatter
     */
    public function findOne(ConnectionInterface $con  = null)
    {
        if ($this->isCacheEnable() && $data = \PlaceQuery::cacheFetch($this->getCacheKey())) {
            if ($data instanceof \Place) {
                return $data;
            } else {
                $model = new \Place();
                $model->fromArray($data);

                return $data;
            }
        }

        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $criteria->limit(1);
        $dataFetcher = $criteria->doSelect($con);

        $data = $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);

        if ($this->isCacheEnable()) {
            \PlaceQuery::cacheStore($this->getCacheKey(), $data->toArray(), $this->getLifeTime());
        }

        return $data;
    }

    // aggregate_column_relation_country_active_places behavior

    /**
     * Finds the related Country objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedCountryActivePlacess($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->countryActivePlacess = \CountryQuery::create()
            ->joinPlace($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedCountryActivePlacess($con)
    {
        foreach ($this->countryActivePlacess as $countryActivePlaces) {
            $countryActivePlaces->updateActivePlaces($con);
        }
        $this->countryActivePlacess = array();
    }

    // aggregate_column_relation_country_total_places behavior

    /**
     * Finds the related Country objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedCountryTotalPlacess($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->countryTotalPlacess = \CountryQuery::create()
            ->joinPlace($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedCountryTotalPlacess($con)
    {
        foreach ($this->countryTotalPlacess as $countryTotalPlaces) {
            $countryTotalPlaces->updateTotalPlaces($con);
        }
        $this->countryTotalPlacess = array();
    }

    // aggregate_column_relation_province_active_places behavior

    /**
     * Finds the related Province objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedProvinceActivePlacess($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->provinceActivePlacess = \ProvinceQuery::create()
            ->joinPlace($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedProvinceActivePlacess($con)
    {
        foreach ($this->provinceActivePlacess as $provinceActivePlaces) {
            $provinceActivePlaces->updateActivePlaces($con);
        }
        $this->provinceActivePlacess = array();
    }

    // aggregate_column_relation_province_total_places behavior

    /**
     * Finds the related Province objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedProvinceTotalPlacess($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->provinceTotalPlacess = \ProvinceQuery::create()
            ->joinPlace($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedProvinceTotalPlacess($con)
    {
        foreach ($this->provinceTotalPlacess as $provinceTotalPlaces) {
            $provinceTotalPlaces->updateTotalPlaces($con);
        }
        $this->provinceTotalPlacess = array();
    }

    // aggregate_column_relation_city_total_places behavior

    /**
     * Finds the related City objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedCityTotalPlacess($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->cityTotalPlacess = \CityQuery::create()
            ->joinPlace($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedCityTotalPlacess($con)
    {
        foreach ($this->cityTotalPlacess as $cityTotalPlaces) {
            $cityTotalPlaces->updateTotalPlaces($con);
        }
        $this->cityTotalPlacess = array();
    }

    // aggregate_column_relation_city_active_places behavior

    /**
     * Finds the related City objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedCityActivePlacess($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->cityActivePlacess = \CityQuery::create()
            ->joinPlace($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedCityActivePlacess($con)
    {
        foreach ($this->cityActivePlacess as $cityActivePlaces) {
            $cityActivePlaces->updateActivePlaces($con);
        }
        $this->cityActivePlacess = array();
    }

} // PlaceQuery
