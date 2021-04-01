<?php

/**
 * @OA\Get(
 *     path="/api/courses",
 *     operationId="AllCoursesShow",
 *     tags={"Course"},
 *     summary="取得所有課程詳情",
 *     description="取得所有課程詳情",
 * 
 *      security={
 *          {
 *               "Authenticate": {}
 *          }
 *      },
 * 
 *     @OA\Response(
 *         response="200", 
 *         description="請求成功"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="找不到課程",
 *     ),
 * )
 */

/**
 * @OA\POST(
 *     path="/api/courses",
 *     operationId="courseCreate",
 *     tags={"Course"},
 *     summary="新增課程",
 *     description="請求時需要附上JWT驗證",
 * 
 *     security={
 *         {
 *              "Authenticate": {}
 *         }
 *     },
 * 
 *     @OA\Parameter(
 *          name="name",
 *          description="課程名稱",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *               type="string"
 *          )
 *      ),
 * 
 *      @OA\Parameter(
 *           name="description",
 *           description="課程描述",
 *           required=false,
 *           in="query",
 *           @OA\Schema(
 *               type="string"
 *           )
 *      ),
 * 
 *      @OA\Parameter(
 *           name="outline",
 *           description="課程大綱",
 *           required=false,
 *           in="query",
 *           @OA\Schema(
 *               type="string"
 *           )
 *      ),
 * 
 *     @OA\Response(
 *         response="200", 
 *         description="請求成功"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="資源不存在",
 *     ),
 * )
 */


/**
 * @OA\Get(
 *     path="/api/courses/{courseId}",
 *     operationId="courseShow",
 *     tags={"Course"},
 *     summary="取得單一課程詳情",
 *     description="取得單一課程詳情",
 * 
 *     security={
 *          {
 *              "Authenticate": {}
 *          }
 *      },
 * 
 *     @OA\Parameter(
 *         name="courseId",
 *         description="Course Id",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response="200", 
 *         description="請求成功"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="找不到對應課程",
 *     ),
 * )
 */

/**
 * @OA\PUT(
 *      path="/api/courses/{id}",
 *      operationId="courseUpdate",
 *      tags={"Course"},
 *      summary="更新課程",
 *      description="更新課程",
 * 
 *      security={
 *          {
 *              "Authenticate": {}
 *          }
 *      },
 * 
 *      @OA\Parameter(
 *          name="id",
 *          description="Course id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="name",
 *          description="課程名稱",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="description",
 *          description="課程描述",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="outline",
 *          description="課程大綱",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="請求成功"
 *       ),
 *      @OA\Response(
 *          response=404,
 *          description="資源不存在"
 *       )
 * )
 * Update course content
 */

/**
 * @OA\Delete(
 *      path="/api/courses/{courseId}",
 *      operationId="courseDelete",
 *      tags={"Course"},
 *      summary="刪除課程",
 *      description="刪除課程",
 * 
 *      security={
 *          {
 *               "Authenticate": {}
 *          }
 *      },
 * 
 *      @OA\Parameter(
 *          name="courseId",
 *          description="Course Id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="請求成功"
 *       ),
 *      @OA\Response(
 *          response=404,
 *          description="資源不存在"
 *       )
 * )
 * Delete course
 */
