<?php

/**
 * @OA\Get(
 *     path="/api/Students",
 *     operationId="AllStudentsShow",
 *     tags={"Student"},
 *     summary="取得所有學生詳情",
 *     description="取得所有學生詳情",
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
 *         description="找不到學生",
 *     ),
 * )
 */

/**
 * @OA\POST(
 *     path="/api/students",
 *     operationId="studentCreate",
 *     tags={"Student"},
 *     summary="新增學生",
 *     description="請求時需要附上JWT驗證",
 * 
 *     security={
 *         {
 *              "Authenticate": {}
 *         }
 *     },
 * 
 *     @OA\Parameter(
 *          name="firstname",
 *          description="性",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *               type="string"
 *          )
 *      ),
 * 
 *      @OA\Parameter(
 *           name="lastname",
 *           description="名",
 *           required=false,
 *           in="query",
 *           @OA\Schema(
 *               type="string"
 *           )
 *      ),
 * 
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
 *     path="/api/students/{studentId}",
 *     operationId="studentShow",
 *     tags={"Student"},
 *     summary="取得單一學生詳情",
 *     description="取得單一學生詳情",
 * 
 *     security={
 *          {
 *              "Authenticate": {}
 *          }
 *      },
 * 
 *     @OA\Parameter(
 *         name="studentId",
 *         description="Student Id",
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
 *         description="找不到對應學生",
 *     ),
 * )
 */

/**
 * @OA\PUT(
 *      path="/api/students/{studentId}",
 *      operationId="studentUpdate",
 *      tags={"Student"},
 *      summary="更新學生資訊",
 *      description="更新學生資訊",
 * 
 *      security={
 *          {
 *              "Authenticate": {}
 *          }
 *      },
 * 
 *      @OA\Parameter(
 *          name="id",
 *          description="Student id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="firstname",
 *          description="性",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="lastname",
 *          description="名",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      
 *      @OA\Response(
 *          response=200,
 *          description="請求成功"
 *       ),
 *      @OA\Response(
 *          response=404,
 *          description="資源不存在"
 *       )
 * )
 * Update student content
 */

/**
 * @OA\Delete(
 *      path="/api/students/{studentId}",
 *      operationId="studentDelete",
 *      tags={"Student"},
 *      summary="刪除學生資訊",
 *      description="刪除學生資訊",
 * 
 *      security={
 *          {
 *               "Authenticate": {}
 *          }
 *      },
 * 
 *      @OA\Parameter(
 *          name="studentId",
 *          description="Student Id",
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
 * Delete student
 */